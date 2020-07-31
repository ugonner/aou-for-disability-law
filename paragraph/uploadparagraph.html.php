<?php include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/htmlpages/header.html.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?php include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/htmlpages/leftbar.html.php"; ?>
            </div>
            <div class="col-sm-5 col-sm-offset-1">
                <div class="row">
                    <div class="col-xs-3  btn btn-danger" style="min-height: 100px;">
                        <h6 class="text-right text-capitalize">upload the law<br> a paragraph<br> at a time<br> as an admin</h6>
                    </div>
                    <div class="col-xs-9 btn btn-primary" style="min-height: 100px;">
                        <div class="">
                            <h4>Upload Paragraph Details Here</h4>
                        </div>
                    </div>
                </div>
                <div>
                    <h5 class="panel-body">
                        <?php if(!empty($error)){echo($error); }?>
                        <?php if(!empty($_GET["output"])){echo($_GET["output"]); }?>
                    </h5>
                    <div class="form-group">
                        <form  method="POST" action="/api/paragraph/index.php">
                            <div class="form-group">
                                <div class="">
                                    <label class="btn btn-sm btn-block btn-danger" for="paragraph-type">
                                        Please Select The Type Of Paragraph This Is</label>
                                    <select class="input-lg form-control" name="paragraphtype" id="paragraph-type" required="required">
                                        <option value="">Please Select</option>
                                        <option value="1">Section Title</option>
                                        <option value="2">Section Paragraph</option>
                                        <option value="3">SubSection Paragraph</option>
                                    </select>
                                </div>
                                <div class="">
                                    <label for="paragraph-title" class="btn btn-sm btn-block btn-danger">Title</label>
                                    <input type="text" class="input-lg form-control" name="title" id="paragraph-title"  required="required"
                                        value="<?php if(!empty($_POST["title"])){echo(trim($_POST["title"]));}?>">
                                </div>
                                <div class="">
                                    <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph text</label>
                                    <textarea rows="10" id="paragraph-text" name="paragraphtext" class="form-control"  required="required"><?php if(!empty($_POST["paragraphtext"])){echo(trim($_POST["paragraphtext"]));}?>
                                    </textarea>
                                </div>
                                <br>
                                <div class="">
                                    <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph Igbo text</label>
                                    <textarea rows="10" id="paragraph-text" name="paragraphigbotext" class="form-control"  required="required"><?php if(!empty($_POST["paragraphigbotext"])){echo(trim($_POST["paragraphigbotext"]));}?>
                                    </textarea>
                                </div>
                                <br>
                                <div class="">
                                    <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph annotation</label>
                                    <textarea rows="10" id="paragraph-text" name="paragraphannotation" class="form-control"><?php if(!empty($_POST["paragraphannotation"])){echo(trim($_POST["paragraphannotation"]));}?>
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="btn btn-lg btn-block btn-primary toggle" data-toggle="collapse" data-target="#sectionid-div">
                                    <small>
                                        Click To Select Section Number <br>
                                        If This Is <b>NOT</b> A Section-title <br>(important)
                                    </small>
                                </div>
                                <div class="collapse" id="sectionid-div">
                                    <label for="sectionid"> Important Select Section Number</label>
                                    <select name="sectionid" id="sectionid" class="input-lg form-control">
                                        <option value="">Please Select</option>
                                        <?php for($i=1; $i<=60; $i++):?>
                                            <option value="<?php echo($i);?>" <?php if((isset($_POST['sectionid'])) && ($i == $_POST['sectionid'])){echo("selected = true");}?>>Section <?php echo($i);?></option>
                                        <?php endfor;?>
                                    </select>

                                    <label for="subsectionno"> Important Select SubSection Number</label>
                                    <select name="subsectionno" id="subsectionno" class="input-lg form-control">
                                        <option value="">Please Select</option>
                                        <?php for($i=1; $i<=20; $i++):?>
                                            <option value="<?php echo($i);?>" <?php if((isset($_POST['subsectionno'])) && ($i == $_POST['subsectionno'])){echo("selected = true");}?>>Section <?php echo($i);?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>

                                <div class="btn btn-lg btn-block btn-primary toggle" data-toggle="collapse" data-target="#subsectionid-div">
                                    <small>
                                        Click To Select SubSection This Belongs To <br>
                                        If This Is A SubSection-Paragraph <br>(important)
                                    </small>

                                </div>
                                <div class="collapse" id="subsectionid-div">
                                    <label for="sectionid"> Important Select SubSection Number</label>
                                    <select name="subsectionid" id="sectionid" class="input-lg form-control">
                                        <option value="">Please Select</option>
                                        <?php for($i=1; $i<=20; $i++):?>
                                            <option value="<?php echo($i);?>" <?php if((isset($_POST['subsectionid'])) && ($i == $_POST['subsectionid'])){echo("selected = true");}?>>SubSection <?php echo($i);?></option>
                                        <?php endfor;?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button type="submit" name="addparagraph" class="btn btn-lg btn-block btn-secondary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <?php include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/htmlpages/rightbar.html.php"; ?>
            </div>
        </div>
    </div>

<?php include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/htmlpages/footer.html.php"; ?>
