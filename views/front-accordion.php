<div class="pmc-container alignfull">
    <select class="building-select" style='width: 350px;'>
        <?php foreach ($building_labels as $key => $value){?>
            <option
                    <?php if ($_GET['building_id'] == $key) echo 'selected';?>
                    value="<?php echo get_permalink()."?building_id={$key}";?>">
                <?php echo $value;?>
            </option>
        <?php } ?>
    </select>
    <div class="pmc-accordion">
        <?php foreach ($buildings as $building){ ?>
            <h1 class="building-name">
                <?php echo $building[0]->building_name;?>
            </h1>
            <?php foreach ($building as $video){?>
                <div class="pmc-accordion-item">
                    <button class="pmc-accordion-handle">
                        <?php
                        if ($video->apartrange) {
                            if(!empty($video->unit)) echo $video->unit;
                            else if(!empty($video->unitn)) echo $video->unitn;
                            echo '-Line Fl ';
                            echo $video->apartmin . '-' . $video->apartmax;
                            if (!empty($video->apartmin2)){
                                echo ' & ' . $video->apartmin2 . '-' . $video->apartmax2;
                            }
                        }else {
                            if(!empty($video->unitf)) echo $video->unitf;
                            if(!empty($video->unitfn)) echo $video->unitfn;
                            if (!empty($video->unit)) echo $video->unit;
                            if (!empty($video->unitn)) if ($video->unitn < 10) echo '0'; echo $video->unitn;
                        }
                        if (!empty($video->label))
                            echo ' ('.$video->label. ')';
                        ?>
                    </button>
                    <div class="pmc-accordion-panel">
                        <?php

                        if(!empty($video->youtube)){
                            echo '<a class="accordion-item" target="_blank" href="'.$video->youtube.'">';

                            if ($video->apartrange) {
                                if(!empty($video->unit)) echo $video->unit;
                                if(!empty($video->unitn)) echo $video->unitn;
                                echo '-Line Fl ';
                                echo $video->apartmin . '-' . $video->apartmax;
                                if (!empty($video->apartmin2)){
                                    echo ' & ' . $video->apartmin2 . '-' . $video->apartmax2;
                                }
                            }else {
                                if(!empty($video->unitf)) echo $video->unitf;
                                if(!empty($video->unitfn)) echo $video->unitfn;
                                if (!empty($video->unit)) echo $video->unit;
                                if (!empty($video->unitn)) if ($video->unitn < 10) echo '0'; echo $video->unitn;
                            }
                            if (!empty($video->label))
                                echo ' ('.$video->label. ')';
                            echo ' Video Link</a>';
                            ?>

                            <iframe class="collapse-video" src="<?php echo $video->youtube; ?>" ></iframe>

                            <?php
                        }else if (!empty($video->vimeo)){
                            echo '<a class="accordion-item" target="_blank" href="'.$video->vimeo.'">';

                            if ($video->apartrange) {
                                if(!empty($video->unit)) echo $video->unit;
                                if(!empty($video->unitn)) echo $video->unitn;
                                echo '-Line Fl ';
                                echo $video->apartmin . '-' . $video->apartmax;
                                if (!empty($video->apartmin2)){
                                    echo ' & ' . $video->apartmin2 . '-' . $video->apartmax2;
                                }
                            }else {
                                if(!empty($video->unitf)) echo $video->unitf;
                                if(!empty($video->unitfn)) echo $video->unitfn;
                                if (!empty($video->unit)) echo $video->unit;
                                if (!empty($video->unitn)) if ($video->unitn < 10) echo '0'; echo $video->unitn;
                            }
                            if (!empty($video->label))
                                echo ' ('.$video->label. ')';
                            echo ' Video Link</a>';

                            $vimeo = $video->vimeo;
                            if (preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $vimeo, $output_array)) {
                                $output_array[5];
                            }
                            ?>

                            <iframe class="collapse-video" src="https://player.vimeo.com/video/<?php echo $output_array[5]; ?>"
                                    frameborder="0" allowfullscreen></iframe>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>