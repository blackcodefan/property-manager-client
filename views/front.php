<div class="pmc-container alignfull">
    <?php foreach ($buildings as $building){ ?>
        <h4 class="address">
            <?php echo $building[0]->building_name;?>
        </h4>
        <div class="wp-block-columns">
            <?php foreach ($building as $video){?>
                <div class="video-column">

                    <?php if (!empty($video->youtube)){ ?>

                        <iframe src="<?php echo $video->youtube; ?>"></iframe>
                        <p class="description">
                            <?php if ($video->bedroom == 0) {
                                echo 'Studio , ';
                            } else {
                                echo $video->bedroom . ' Bedroom , ';
                            }
                            echo $video->bathroom . ' Bathroom</br>';
                            if (!empty($video->unitf)) {
                                echo $video->unitf . '</br>';
                            }
                            if (!empty($video->apartrange)) {

                                echo $type = 'F-Line Fl ';

                                echo $video->apartmin . '-' . $video->apartmax . '</br>';
                            }

                            echo $video->address;
                            echo '</br>' . $video->building_name;
                            ?>
                        </p>
                    <?php }?>

                    <?php if (!empty($video->vimeo)) { ?>

                        <?php
                        $vimeo = $video->vimeo;
                        if (preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $vimeo, $output_array)) {
                            $output_array[5];
                        }
                        ?>
                        <iframe src="https://player.vimeo.com/video/<?php echo $output_array[5]; ?>"
                                frameborder="0" allowfullscreen></iframe>

                        <p class="description">
                            <?php if ($video->bedroom == 0) {
                                echo 'Studio , ';
                            } else {
                                echo $video->bedroom . ' Bedroom , ';
                            }
                            echo $video->bathroom . ' Bathroom</br>';

                            if (!empty($video->apartrange == 'yes')) {

                                echo $type = $video->unitf . '-Line Fl ';

                                echo $video->apartmin . '-' . $video->apartmax . '</br>';
                            } else {
                                if (!empty($video->unitf)) {
                                    echo $video->unitf . '</br>';
                                }
                            }
                            echo $video->address;
                            echo '</br>' . $video->building_name;
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
            <?php }?>
        </div>
    <?php } ?>
</div>
