<?php $isAdmin = true; $Admin=true;?>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/htmlpages/header.html.php"; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2 col-sm-offset-1">
            <br/>
            <button class="btn btn-info btn-lg btn-block" data-toggle="collapse" data-target="#sectionlistdiv">
                Look Up Sections
            </button>
            <div class="collapse" id="sectionlistdiv">
                <?php for($i=1; $i<58; $i++):?>
                    <a href="/api/paragraph/?getsection&sectionid=<?php echo($i);?>" class="btn btn-lg btn-primary btn-block">
                        Section <?php echo($i);?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>

        <div class="col-sm-6">
        <h3 class="panel-body">
            <?php if(!empty($error)){echo($error); }?>
            <?php if(!empty($_GET["output"])){echo($_GET["output"]); }?>
        </h3>
            <?php if(!empty($section)):?>
                <?php $section_1 = $section["sections"][0];?>
                <div class="row">
                    <div class="col-xs-3 btn btn-primary">
                        <div class="">
                            <h6 class="panel-heading">Section</h6>
                            <h4 class="panel-heading"><?php echo($section_1["id"]);?></h4>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="btn btn-danger btn-block" style="min-height: 99px;">
                            <div class="">
                                <div id="sectionigbodiv<?php echo($section_1['id']);?>" class="collapse fade in active">
                                    <h6><i>Igbo</i></h6>
                                    <p><?php echo($section_1["paragraphigbotext"]);?></p>
                                </div>
                                <div id="sectionenglishdiv<?php echo($section_1['id']);?>" class="collapse fade">
                                    <h6><i>English</i></h6>
                                    <p><?php echo($section_1["title"]);?>.</p>
                                </div>
                                <div id="sectionannotationdiv<?php echo($section_1['id']);?>" class="collapse fade">
                                    <h6><i>What This Means</i></h6>
                                    <p><?php echo($section_1["paragraphannotation"]);?>.</p>
                                </div>
                            </div>

                            <div class="text-right">
                                <a class="badge" data-toggle="collapse" data-target="#sectionigbodiv<?php echo($section_1['id']);?>">I</a>
                                <a class="badge" data-toggle="collapse"  data-target="#sectionenglishdiv<?php echo($section_1['id']);?>">E</a>
                                <a  class="badge" data-toggle="collapse" data-target="#sectionannotationdiv<?php echo($section_1['id']);?>"><span class="glyphicon glyphicon-question-sign"></span></a>
                                <?php if($isAdmin):?>
                                    <a class="badge" data-toggle="collapse" data-target="#editsectionparagraph<?php echo($section_1['id']);?>">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if($isAdmin):?>
                            <div class="collapse" id="editsectiondiv<?php echo($section_1['id']);?>">

                                <div>
                                    <div class="form-group">
                                        <form  method="POST" action="/api/paragraph/index.php">
                                            <div class="form-group">
                                                <div class="">
                                                    <input type="hidden" name="paragraphtype" value="1">
                                                </div>
                                                <div class="">
                                                    <label for="paragraph-title" class="btn btn-sm btn-block btn-danger">Title</label>
                                                    <input type="text" class="input-lg form-control" name="title" id="paragraph-title"  required="required"
                                                           value="<?php if(!empty($_POST["title"])){echo(trim($_POST["title"]));}else{echo($section_1["title"]);}?>">
                                                </div>
                                                <div class="">
                                                    <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph text</label>
                                                    <textarea rows="10" id="paragraph-text" name="paragraphtext" class="form-control"  required="required"><?php if(!empty($_POST["paragraphtext"])){echo(trim($_POST["paragraphtext"]));}else{echo($section_1["paragraphtext"]);}?>
                                                    </textarea>
                                                </div>
                                                <br>
                                                <div class="">
                                                    <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph Igbo text</label>
                                                    <textarea rows="10" id="paragraph-text" name="paragraphigbotext" class="form-control"  required="required"><?php if(!empty($_POST["paragraphigbotext"])){echo(trim($_POST["paragraphigbotext"]));}else{echo($section_1["paragraphigbotext"]);}?>
                                                    </textarea>
                                                </div>
                                                <br>
                                                <div class="">
                                                    <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph annotation</label>
                                                    <textarea rows="10" id="paragraph-text" name="paragraphannotation" class="form-control"><?php if(!empty($_POST["paragraphannotation"])){echo(trim($_POST["paragraphannotation"]));}else{echo($section_1["paragraphannotation"]);}?>
                                                    </textarea>
                                                </div>
                                            </div>

                                            <input type="hidden" name="sectionid" value="<?php echo($section_1['id']);?>">
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" name="editparagraph" class="btn btn-lg btn-block btn-secondary">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

                <?php if(!empty($sectionparagrahs)):?>
                    <?php if(count($sectionparagrahs)>0):?>
                        <?php foreach($sectionparagrahs as $sp):?>
                            <!--<li> <?php /*echo($sp["paragraphigbotext"]);*/?></li>
                                -->

                            <div class="row">
                                <div class="col-xs-2 text-center" style="background: firebrick">
                                    <h6 class="">SubSection </h6><?php echo(1+(array_search($sp,$sectionparagrahs)));?>
                                </div>
                                <div class="col-xs-10" style="background: navy;">

                                    <div class="">
                                        <div id="sectionparagraphigbodiv<?php echo($sp['id']);?>" class="collapse fade in active">
                                            <h6><i>Igbo</i></h6>
                                            <p><?php echo($sp["paragraphigbotext"]);?></p>
                                        </div>
                                        <div id="sectionparagraphenglishdiv<?php echo($sp['id']);?>" class="collapse fade">
                                            <h6><i>English</i></h6>
                                            <p><?php echo($sp["paragraphtext"]);?>.</p>
                                        </div>
                                        <div id="sectionparagraphannotationdiv<?php echo($sp['id']);?>" class="collapse fade">
                                            <h6><i>What This Means</i></h6>
                                            <p><?php echo($sp["paragraphannotation"]);?>.</p>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <a class="badge" data-toggle="collapse" data-target="#sectionparagraphigbodiv<?php echo($sp['id']);?>">I</a>
                                        <a class="badge" data-toggle="collapse"  data-target="#sectionparagraphenglishdiv<?php echo($sp['id']);?>">E</a>
                                        <a  class="badge" data-toggle="collapse" data-target="#sectionparagraphannotationdiv<?php echo($sp['id']);?>"><span class="glyphicon glyphicon-question-sign"></span></a>
                                        <?php if($isAdmin):?>
                                            <a class="badge" data-toggle="collapse" data-target="#editsectionparagraph<?php echo($sp['id']);?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>


                                    <!--edit panel goes here-->
                                    <?php if($isAdmin):?>
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-6">

                                                <div class="collapse" id="editsectionparagraph<?php echo($sp['id']); ?>">

                                                    <div>
                                                        <div class="form-group">
                                                            <form  method="POST" action="/api/paragraph/index.php">
                                                                <div class="form-group">
                                                                    <div class="">
                                                                        <input type="hidden" name="paragraphtype" value="2">
                                                                    </div>
                                                                    <div class="">
                                                                        <label for="paragraph-title" class="btn btn-sm btn-block btn-danger">Title</label>
                                                                        <input type="text" class="input-lg form-control" name="title" id="paragraph-title"  required="required"
                                                                               value="<?php if(!empty($_POST["title"])){echo(trim($_POST["title"]));}else{echo($sp["title"]);}?>">
                                                                    </div>
                                                                    <div class="">
                                                                        <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph text</label>
                                                                        <textarea rows="10" id="paragraph-text" name="paragraphtext" class="form-control"  required="required"><?php if(!empty($_POST["paragraphtext"])){echo(trim($_POST["paragraphtext"]));}else{echo($sp["paragraphtext"]);}?>
                                                                        </textarea>
                                                                    </div>
                                                                    <br>
                                                                    <div class="">
                                                                        <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph Igbo text</label>
                                                                        <textarea rows="10" id="paragraph-text" name="paragraphigbotext" class="form-control"  required="required"><?php if(!empty($_POST["paragraphigbotext"])){echo(trim($_POST["paragraphigbotext"]));}else{echo($sp["paragraphigbotext"]);}?>
                                                                        </textarea>
                                                                    </div>
                                                                    <br>
                                                                    <div class="">
                                                                        <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph annotation</label>
                                                                        <textarea rows="10" id="paragraph-text" name="paragraphannotation" class="form-control"><?php if(!empty($_POST["paragraphannotation"])){echo(trim($_POST["paragraphannotation"]));}else{echo($sp["paragraphannotation"]);}?>
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
                                                                                <option value="<?php echo($i);?>" <?php if($i == $sp['sectionid']){echo("selected=true");}?>>Section <?php echo($i);?></option>
                                                                            <?php endfor;?>
                                                                        </select>
                                                                    </div>


                                                                    <input type="hidden" name="sectionparagraphid" value="<?php echo($sp['id']);?>">
                                                                    <input type="hidden" name="old_sectionid" value="<?php echo($sp['sectionid']);?>">


                                                                </div>
                                                                <div class="form-group">
                                                                    <div>
                                                                        <button type="submit" name="editparagraph" class="btn btn-lg btn-block btn-secondary">
                                                                            Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3"></div>
                                        </div>
                                    <?php endif;?>
                                    <!--edit aanel ends-->



                                    <!--displaying subsectionparagraphs here-->

                                    <br>&nbsp;
                                    <?php $subsectionparagraphs = $sp["subsectionparagraphs"];
                                    if(!empty($sectionparagrahs)):?>
                                        <?php if(count($subsectionparagraphs)>0):?>
                                            <?php foreach($subsectionparagraphs as $ssp):?>
                                                <!--<li> <?php /*echo($sp["paragraphigbotext"]);*/?></li>
                                -->

                                                <div class="row"">
                                                    <div class="col-xs-2 text-center" style="background: firebrick;">
                                                        <h6>Paragraph</h6>
                                                        <?php echo(1+(array_search($ssp,$subsectionparagraphs)));?>
                                                    </div>
                                                    <div class="col-xs-10" style="background: darkblue;">
                                                        <div>
                                                            <div id="igbodivsp<?php echo($sp['id']);?>ssp<?php echo($ssp['id']);?>" class="collapse fade in active">
                                                                <h6><i>Igbo</i></h6>
                                                                <h5><?php echo($ssp["paragraphigbotext"]);?></h5>
                                                            </div>
                                                            <div id="englishdivsp<?php echo($sp['id']);?>ssp<?php echo($ssp['id']);?>" class="collapse fade">
                                                                <h6><i>English</i></h6>
                                                                <p><?php echo($ssp["paragraphtext"]);?>.</p>
                                                            </div>
                                                            <div id="annotationdivsp<?php echo($sp['id']);?>ssp<?php echo($ssp['id']);?>" class="collapse fade">
                                                                <h6><i>What This Means</i></h6>
                                                                <p><?php echo($ssp["paragraphannotation"]);?>.</p>
                                                            </div>
                                                        </div>

                                                        <br>
                                                        <div class="list-inline text-right">
                                                            <a class="badge" data-toggle="collapse" data-target="#igbodivsp<?php echo($sp['id']);?>ssp<?php echo($ssp['id']);?>">I</a>
                                                            <a class="badge" data-toggle="collapse" data-target="#englishdivsp<?php echo($sp['id']);?>ssp<?php echo($ssp['id']);?>">E</a>
                                                            <a class="badge" data-toggle="collapse" data-target="#annotationdivsp<?php echo($sp['id']);?>ssp<?php echo($ssp['id']);?>">
                                                                <span class="glyphicon glyphicon-question-sign"></span>
                                                            </a>
                                                            <?php if($isAdmin):?>
                                                                <a class="badge" data-toggle="collapse" data-target="#editsubsectionparagraphsp<?php echo($sp['id']);?>ssp<?php echo($ssp['id']);?>">
                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                </a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                    <!--edit subsection paragraph start here-->
                                                    <?php if($isAdmin):?>
                                                        <div class="row">
                                                            <div class="col-sm-3"></div>
                                                            <div class="col-sm-6">
                                                                <div class="collapse" id="editsubsectionparagraphsp<?php echo($sp['id']);?>ssp<?php echo($ssp['id']);?>">

                                                                    <div class="form-group">
                                                                        <form  method="POST" action="/api/paragraph/index.php">
                                                                            <div class="form-group">
                                                                                <div class="">
                                                                                    <input type="hidden" name="paragraphtype" value="3">
                                                                                </div>
                                                                                <div class="">
                                                                                    <label for="paragraph-title" class="btn btn-sm btn-block btn-danger">Title</label>
                                                                                    <input type="text" class="input-lg form-control" name="title" id="paragraph-title"  required="required"
                                                                                           value="<?php if(!empty($_POST["title"])){echo(trim($_POST["title"]));}else{echo($ssp["title"]);}?>">
                                                                                </div>
                                                                                <div class="">
                                                                                    <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph text</label>
                                                                                    <textarea rows="10" id="paragraph-text" name="paragraphtext" class="form-control"  required="required"><?php if(!empty($_POST["paragraphtext"])){echo(trim($_POST["paragraphtext"]));}else{echo($ssp["paragraphtext"]);}?>
                                                                                    </textarea>
                                                                                </div>
                                                                                <br>
                                                                                <div class="">
                                                                                    <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph Igbo text</label>
                                                                                    <textarea rows="10" id="paragraph-text" name="paragraphigbotext" class="form-control"  required="required"><?php if(!empty($_POST["paragraphigbotext"])){echo(trim($_POST["paragraphigbotext"]));}else{echo($ssp["paragraphigbotext"]);}?>
                                                                                    </textarea>
                                                                                </div>
                                                                                <br>
                                                                                <div class="">
                                                                                    <label for="paragraph-text" class="btn btn-sm btn-block btn-danger">Paragraph annotation</label>
                                                                                    <textarea rows="10" id="paragraph-text" name="paragraphannotation" class="form-control"><?php if(!empty($_POST["paragraphannotation"])){echo(trim($_POST["paragraphannotation"]));}else{echo($ssp["paragraphannotation"]);}?>
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
                                                                                            <option value="<?php echo($i);?>" <?php if($i==$ssp['sectionid']){echo("selected = true");}?>>Section <?php echo($i);?></option>
                                                                                        <?php endfor;?>
                                                                                    </select>
                                                                                </div>

                                                                                <div class="btn btn-lg btn-block btn-primary toggle" data-toggle="collapse" data-target="#subsectionid-div">
                                                                                    <small>
                                                                                        Click To Select The SubSection It Belongs To <br>
                                                                                        If This Is A SubSection-Paragraph <br>(important)
                                                                                    </small>

                                                                                </div>
                                                                                <div class="collapse" id="subsectionid-div">
                                                                                    <label for="sectionid"> Important Select SubSection Number</label>
                                                                                    <select name="subsectionid" id="sectionid" class="input-lg form-control">
                                                                                        <option value="">Please Select</option>
                                                                                        <?php for($i=1; $i<=20; $i++):?>
                                                                                            <option value="<?php echo($i);?>" <?php if($i==$ssp['subsectionid']){echo("selected = true");}?>>SubSection <?php echo($i);?></option>
                                                                                        <?php endfor;?>
                                                                                    </select>

                                                                                    <input type="hidden" name="subsectionparagraphid" value="<?php echo($ssp['id']);?>">
                                                                                    <input type="hidden" name="old_sectionid" value="<?php echo($ssp['sectionid']);?>">
                                                                                    <input type="hidden" name="old_subsectionid" value="<?php echo($ssp['subsectionid']);?>">
                                                                                </div>

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div>
                                                                                    <button type="submit" name="editparagraph" class="btn btn-lg btn-block btn-secondary">
                                                                                        Save
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3"></div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <!--edit subsection paragraph ends here-->

                                                </div>

                                            <?php endforeach;?>

                                        <?php else:?>

                                        <?php endif;?>
                                    <?php endif;?>
                                    <!--displaying subsectionparagraphs here ends-->
                                </div>
                            </div>

                        <?php endforeach;?>

                    <?php else:?>

                    <?php endif;?>
                <?php endif;?>
            <?php else:?>
                <h3 class="panel-body">
                    <?php if(!empty($error)){echo($error); }?>
                    <?php if(!empty($_GET["output"])){echo($_GET["output"]); }?>
                </h3>

                <h3 class="panel-heading"><span class="glyphicon glyphicon-arrow-left"></span> Select Section </h3>
            <?php endif;?>

        </div>
        <div class="col-sm-3">
            <?php include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/htmlpages/rightbar.html.php"; ?>
        </div>
    </div>
</div>
<?php include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/htmlpages/footer.html.php"; ?>
