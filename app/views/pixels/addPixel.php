<?php require APPROOT . '/views/includes/head.php'; ?>


<div class="row">
    <div class="col-6 align-center">

        <?php feedback('success'); ?>
        <h2>Add pixels</h2>

        <!-- AFTER SUBMIT - IF PIXEL OUT OF CONTAINER ERROR -->
        <?php if (isset($data['errors']['pixelOutOfContainer'])) : ?>
            <div class="alert alert-dismissible alert-danger text-center">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div><?php echo $data['errors']['pixelOutOfContainer'] ?></div>
            </div>
        <?php endif; ?>


        <form action="" method="post" id="addPixelForm">
            <input type="hidden" name="userId" value=" <?php echo $_SESSION['userId']; ?>">
            <div class="form-group">
                <label for="coordinateX">Enter coordinate X</label>
                <!--   Coordinate X  -->
                <input type="text" name="coordinateX" id="coordinateX"
                       class="form-control <?php echo !empty($data['errors']['xErr']) ? 'is-invalid' : ''; ?>"
                       placeholder="X" aria-describedby="helpId"
                       value="<?php echo $data['fromPostData']['x'] ?? null; ?>">
                <span class="invalid-feedback"><?php echo $data['errors']['xErr'] ?? null; ?></span>

            </div>
            <div class="form-group">
                <label for="coordinateY">Enter coordinate Y</label>
                <!--   Coordinate Y  -->
                <input type="text" name="coordinateY" id="coordinateY"
                       class="form-control <?php echo !empty($data['errors']['yErr']) ? 'is-invalid' : ''; ?>"
                       placeholder="Y"
                       aria-describedby="helpId" value="<?php echo $data['fromPostData']['y'] ?? null; ?>">
                <span class="invalid-feedback"><?php echo $data['errors']['yErr'] ?? null; ?></span>

            </div>

            <div class="form-group">
                <div class="custom-control custom-radio " id="blue1 ">
                    <input type="radio"
                           id="blue" value="blue" name="color" class="custom-control-input" checked>

                    <label class="custom-control-label" for="blue">blue</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio"
                           id="red" <?php echo !empty($data['fromPostData']['color']) ? ($data['fromPostData']['color'] === 'red' ? 'checked' : '') : ''; ?>
                           value="red" name="color" class="custom-control-input">
                    <label class="custom-control-label" for="red">red</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio"
                           id="yellow" <?php echo !empty($data['fromPostData']['color']) ? ($data['fromPostData']['color'] === 'yellow' ? 'checked' : '') : ''; ?>
                           value="yellow" name="color" class="custom-control-input">
                    <label class="custom-control-label" for="yellow">yellow</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio"
                           id="green" <?php echo !empty($data['fromPostData']['color']) ? ($data['fromPostData']['color'] === 'green' ? 'checked' : '') : ''; ?>
                           value="green" name="color" class="custom-control-input">
                    <label class="custom-control-label" for="green">green</label>
                </div>
                <span class="invalid-feedback"><?php echo $data['errors']['colorErr'] ?? null; ?></span>
            </div>


            <div class="form-group mt-3">
                <div class="range-wrap">
                    <div class="range-value" id="rangeV"></div>
                    <input id="range" name="size" type="range" min="1" max="20"
                           value="<?php echo !empty($data['fromPostData']['size']) ? $data['fromPostData']['size'] : 10; ?>"
                           step="1">
                </div>
            </div>
            <button type="submit" class="btn btn-secondary my-2">Add pixel</button>
        </form>

    </div>

</div>

<?php //var_dump($data); ?>
<?php require APPROOT . '\views\includes\footer.php'; ?>
