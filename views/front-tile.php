<div class="pmc-container alignfull">
    <div class="paginator">
        <?php foreach ($building_labels as $key => $value){?>
            <a class="building-button" href="<?php echo get_permalink()."?building_id={$key}";?>">
                <?php echo $value;?>
            </a>
        <?php } ?>
    </div>

    <?php foreach ($buildings as $building) { ?>
        <h1 class="building-name">
            <?php echo $building[0]->building_name; ?>
        </h1>
        <div class="pmc-row">
            <?php foreach ($building as $video) { ?>
                <div class="tile">
                    <div>
                        <?php if (!empty($video->youtube)) { ?>

                            <iframe src="<?php echo $video->youtube; ?>" class="tile-video"></iframe>
                            <p class="description">
                                <?php if ($video->bedroom == 0) {
                                    echo 'Studio, ';
                                } else {
                                    echo $video->bedroom . ' Bedroom, ';
                                }
                                echo $video->bathroom . ' Bathroom</br>';

                                if ($video->apartrange) {

                                    if (!empty($video->unit)) echo $video->unit;
                                    if (!empty($video->unitn)) echo $video->unitn;
                                    echo '-Line Fl ';

                                    echo $video->apartmin . '-' . $video->apartmax . '</br>';
                                    if (!empty($video->apartmin2)){
                                        echo ' & ' . $video->apartmin2 . '-' . $video->apartmax2;
                                    }
                                } else {
                                    if (!empty($video->unitf)) echo $video->unitf;
                                    if (!empty($video->unitfn)) echo $video->unitfn;
                                    if (!empty($video->unit)) echo $video->unit;
                                    if (!empty($video->unitn)) if ($video->unitn < 10) echo '0';
                                    echo $video->unitn;
                                    echo '<br/>';
                                }

                                echo $video->description . '<br/>';
                                echo $video->address;
                                ?>
                            </p>
                        <?php } ?>
                        <?php if (!empty($video->vimeo)) { ?>

                            <?php
                            $vimeo = $video->vimeo;
                            if (preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $vimeo, $output_array)) {
                                $output_array[5];
                            }
                            ?>
                            <iframe class="tile-video"
                                    src="https://player.vimeo.com/video/<?php echo $output_array[5]; ?>"
                                    frameborder="0" allowfullscreen></iframe>

                            <p class="description">
                                <?php if ($video->bedroom == 0) {
                                    echo 'Studio, ';
                                } else {
                                    echo $video->bedroom . ' Bedroom, ';
                                }
                                echo $video->bathroom . ' Bathroom</br>';

                                if (!empty($video->apartrange)) {
                                    if (!empty($video->unit)) echo $video->unit;
                                    if (!empty($video->unitn)) echo $video->unitn;
                                    echo '-Line Fl ';

                                    echo $video->apartmin . '-' . $video->apartmax . '</br>';
                                    if (!empty($video->apartmin2)){
                                        echo ' & ' . $video->apartmin2 . '-' . $video->apartmax2;
                                    }
                                } else {
                                    if (!empty($video->unitf)) echo $video->unitf;
                                    if (!empty($video->unitfn)) echo $video->unitfn;
                                    if (!empty($video->unit)) echo $video->unit;
                                    if (!empty($video->unitn)) if ($video->unitn < 10) echo '0';
                                    echo $video->unitn;
                                    echo '<br/>';
                                }
                                echo $video->description . '<br/>';
                                echo $video->address;
                                ?>
                            </p>

                        <?php } ?>
                        <?php if (!empty($video->wistia)) { ?>
                            <a href="<?php echo $video->wistia; ?>"><?php echo $video->wistia; ?></a>
                            <p class="has-text-align-center has-black-color has-text-color has-medium-font-size">
                                <?php echo $video->bedroom . 'Bedroom , ';
                                echo $video->bathroom . 'Bathroom';
                                echo $video->building_name;
                                echo '</br>' . $video->address; ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="paginator">
        <?php foreach ($building_labels as $key => $value){?>
            <a class="building-button" href="<?php echo get_permalink()."?building_id={$key}";?>">
                <?php echo $value;?>
            </a>
        <?php } ?>
    </div>
</div>
