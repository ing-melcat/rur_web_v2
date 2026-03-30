<style>
     .model-container {
            height: 450px;
            width: 700px;
        }

        model-viewer {
            height: 100%;
            width: 100%;
        }
</style>

<div class="model-container">
        <model-viewer alt="spatial rover" src="<?php echo $glbPath; ?>" autoplay camera-controls
            touch-action="pan-y" disable-zoom camera-orbit="30deg 75deg 105%" min-camera-orbit="auto 75deg auto"
            max-camera-orbit="auto 75deg auto">

        </model-viewer>
    </div>