<div id="accordion" class="pmc-container alignfull">
    <?php foreach ($buildings as $building){ ?>
        <h1>
            <?php echo $building[0]->building_name;?>
        </h1>
        <?php foreach ($building as $video){?>
            <div class="card accordion-item">
                <div class="card-header">
                    <a class="card-link collapse-handle" data-toggle="collapse" href="#<?php echo "accordion-".$video->id; ?>">
                        <?php
                        if ($video->apartrange) {
                            if(!empty($video->unitf)) echo $video->unitf;
                            if(!empty($video->unitfn)) echo $video->unitfn;
                            echo '-Line Fl ';
                            echo $video->apartmin . '-' . $video->apartmax;
                        }else {
                            if(!empty($video->unitf)) echo $video->unitf;
                            if(!empty($video->unitfn)) echo $video->unitfn;
                            if (!empty($video->unit)) echo $video->unit;
                            if (!empty($video->unitn)) if ($video->unitn < 10) echo '0'; echo $video->unitn;
                        }
                        if (!empty($video->label))
                            echo ' ('.$video->label. ')';
                        ?>
                    </a>
                </div>
                <div id="<?php echo "accordion-".$video->id; ?>" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <?php

                        if(!empty($video->youtube)){
                            echo '<a class="accordion-item" target="_blank" href="'.$video->youtube.'">';

                            if ($video->apartrange) {
                                if(!empty($video->unitf)) echo $video->unitf;
                                if(!empty($video->unitfn)) echo $video->unitfn;
                                echo '-Line Fl ';
                                echo $video->apartmin . '-' . $video->apartmax;
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
                                echo $type = $video->unitf . '-Line Fl ';
                                echo $video->apartmin . '-' . $video->apartmax;
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
            </div>
        <?php } ?>
    <?php } ?>
</div>