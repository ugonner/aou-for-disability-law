<?php
/*header("Access-Control-Accept-Orign: *");
header("Access-Control-Accept-Methods: POST");*/

if($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    // Tell the Client we support invocations from arunranga.com and
    // that this preflight holds good for only 20 days

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-type');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 1728000');
    header("Content-Length: 0");
    header("Content-Type: text/plain");
    exit;

} elseif($_SERVER['REQUEST_METHOD'] == "POST") {
    // do something with POST data
    session_start();
    header('Access-Control-Allow-Origin: *');
    /*    header('Content-Type: text/plain');*/
}
require_once $_SERVER["DOCUMENT_ROOT"]."/api/paragraph/paragraph.class.php";

$input = json_decode(file_get_contents('php://input'),true);

//validation function;
function checkForValue($value,$filter_fxn,$output_text,$direct_url){
    if((empty($value)) && !$filter_fxn){
        $error = $output_text;
        require_once $_SERVER["DOCUMENT_ROOT"].$direct_url;
        exit;
    }
}


//get laww
if(isset($input["getlaw"])){
    $paragraph = new Paragraph();
    if($result = $paragraph->getLaw()){
        $message = "Laws Fetched successfully";
    }else{
        $result = "0";
        $message = "No Laws Found Yet Check Later";
    }
    echo(json_encode(array("result"=>$result, "message"=>$message)));
    exit;
}

if(isset($_GET["getsection"])){
    checkForValue($_GET["sectionid"],filter_var($_GET["sectionid"],FILTER_VALIDATE_INT),"No Section Selected","/api/paragraph/section.html.php");
    $sectionid =  ($_GET["sectionid"]);

    $paragraph = new Paragraph();
    if($section = $paragraph->getSection($sectionid)){
        //sort subsection;
        $sectionparagrahs = $section["sectionparagraphs"];
        $subsectionparagraphs = $section["subsectionparagraphs"];
        //echo json_encode($sectionparagrahs)." <br><br>".json_encode($subsectionparagraphs); exit;
        if(!empty($sectionparagrahs)){
            for($i=0; $i<count($sectionparagrahs); $i++){
                if(!empty($subsectionparagraphs)){
                    for($l=0; $l<count($subsectionparagraphs); $l++){
                        if($sectionparagrahs[$i]["subsectionno"]== $subsectionparagraphs[$l]["subsectionid"]){
                            $sectionparagrahs[$i]["subsectionparagraphs"][] = $subsectionparagraphs[$l];
                        }
                    }
                }
            }
        }
        //echo json_encode($sectionparagrahs)." <br><br>".json_encode($subsectionparagraphs); exit;
        require_once $_SERVER["DOCUMENT_ROOT"]."/api/paragraph/section.html.php";
        exit;

    }
    header("Location: /api/paragraph/section.html.php");
    exit;
}

if(isset($_POST["addparagraph"])){

    checkForValue($_POST["paragraphtype"],filter_var($_POST["paragraphtype"],FILTER_VALIDATE_INT),"Wrong / No Value selected, Please Select paragraph type","/api/paragraph/uploadparagraph.html.php");

    checkForValue($_POST["paragraphtext"],filter_var($_POST["paragraphtext"],FILTER_SANITIZE_STRING),"Wrong / No Value for Paragraph text","/api/paragraph/uploadparagraph.html.php");
    checkForValue($_POST["paragraphigbotext"],filter_var($_POST["paragraphigbotext"],FILTER_SANITIZE_STRING),"Wrong / No Value for Paragraph Igbo text","/api/paragraph/uploadparagraph.html.php");
    checkForValue($_POST["paragraphannotation"],filter_var($_POST["paragraphannotation"],FILTER_SANITIZE_STRING),"Wrong / No Value for Paragraph Annotation text","/api/paragraph/uploadparagraph.html.php");

    $paragraphtext =  ($_POST["paragraphtext"]);
    $paragraphigbotext =  ($_POST["paragraphigbotext"]);
    $paragraphannotation =  ($_POST["paragraphannotation"]);
    $title =  ($_POST["title"]);

    $paragraph = new Paragraph();

    if($_POST["paragraphtype"] == 3){
        checkForValue($_POST["sectionid"],filter_var($_POST["sectionid"],FILTER_VALIDATE_INT),"Wrong / No Value for section Number","/api/paragraph/uploadparagraph.html.php");
        checkForValue($_POST["subsectionid"],filter_var($_POST["subsectionid"],FILTER_VALIDATE_INT),"Wrong / No Value for Subsection Number","/api/paragraph/uploadparagraph.html.php");
        $sectionid = (empty($_POST["sectionid"])? 0 :  ($_POST["sectionid"]));
        $subsectionid = (empty($_POST["subsectionid"])? 0 :  ($_POST["subsectionid"]));

        if($paragraph->addSubSectionParagraph($title,$paragraphtext,$paragraphigbotext,$paragraphannotation,$sectionid,$subsectionid)){
            $output = "Paragraph successfully published";
            header("Location: /api/paragraph/uploadparagraph.html.php?output=".$output);
            exit;
        }
    }elseif($_POST["paragraphtype"] == 2){
        checkForValue($_POST["sectionid"],filter_var($_POST["sectionid"],FILTER_VALIDATE_INT),"Wrong / No Value for section Number","/api/paragraph/uploadparagraph.html.php");
        checkForValue($_POST["subsectionno"],filter_var($_POST["subsectionno"],FILTER_VALIDATE_INT),"Wrong / No Value for section Number","/api/paragraph/uploadparagraph.html.php");
        $sectionid = (empty($_POST["sectionid"])? 0 :  ($_POST["sectionid"]));
        $subsectionno = (empty($_POST["subsectionno"])? 0 :  ($_POST["subsectionno"]));

        if($paragraph->addSectionParagraph($title,$paragraphtext,$paragraphigbotext,$paragraphannotation,$sectionid,$subsectionno)){
            $output = "Paragraph successfully published";
            header("Location: /api/paragraph/uploadparagraph.html.php?output=".$output);
            exit;
        }

    }elseif($_POST["paragraphtype"] == 1){
        checkForValue($_POST["title"],filter_var($_POST["title"],FILTER_SANITIZE_STRING),"Wrong / No Value for Section Title","/api/paragraph/uploadparagraph.html.php");

        if($paragraph->addSection($title,$paragraphtext,$paragraphigbotext,$paragraphannotation)){
        $output = "Paragraph successfully published";
        header("Location: /api/paragraph/uploadparagraph.html.php?output=".$output);
        exit;
        }
    }else{
        $error = "Paragraph not published , Try Again";
        require_once $_SERVER["DOCUMENT_ROOT"]."/api/paragraph/uploadparagraph.html.php";
        exit;
    }
}



if(isset($_POST["editparagraph"])){
    checkForValue($_POST["paragraphtype"],filter_var($_POST["paragraphtype"],FILTER_VALIDATE_INT),"Wrong / No Value selected, Please Select paragraph type","/api/paragraph/uploadparagraph.html.php");

    checkForValue($_POST["paragraphtext"],filter_var($_POST["paragraphtext"],FILTER_SANITIZE_STRING),"Wrong / No Value for Paragraph text","/api/paragraph/uploadparagraph.html.php");
    checkForValue($_POST["paragraphigbotext"],filter_var($_POST["paragraphigbotext"],FILTER_SANITIZE_STRING),"Wrong / No Value for Paragraph Igbo text","/api/paragraph/uploadparagraph.html.php");
    checkForValue($_POST["paragraphannotation"],filter_var($_POST["paragraphannotation"],FILTER_SANITIZE_STRING),"Wrong / No Value for Paragraph Annotation text","/api/paragraph/uploadparagraph.html.php");

    $paragraphtext =  ($_POST["paragraphtext"]);
    $paragraphigbotext =  ($_POST["paragraphigbotext"]);
    $paragraphannotation =  ($_POST["paragraphannotation"]);
    $title =  ($_POST["title"]);

    $paragraph = new Paragraph();

    if($_POST["paragraphtype"] == 3){
        checkForValue($_POST["sectionid"],filter_var($_POST["sectionid"],FILTER_VALIDATE_INT),"Wrong / No Value for section Number","/api/paragraph/uploadparagraph.html.php");
        checkForValue($_POST["subsectionid"],filter_var($_POST["subsectionid"],FILTER_VALIDATE_INT),"Wrong / No Value for Subsection Number","/api/paragraph/uploadparagraph.html.php");
        $sectionid = (empty($_POST["sectionid"])? 0 :  ($_POST["sectionid"]));
        $subsectionid = (empty($_POST["subsectionid"])? 0 :  ($_POST["subsectionid"]));
        $subsectionparagraphid = (empty($_POST["subsectionparagraphid"])? 0 :  ($_POST["subsectionparagraphid"]));

        if($paragraph->editSubSectionParagraph($subsectionparagraphid,$title,$paragraphtext,$paragraphigbotext,$paragraphannotation,$sectionid,$subsectionid)){
            $output = "Paragraph successfully edited";
            header("Location: /api/paragraph/section.html.php?output=".$output);
            exit;
        }
    }elseif($_POST["paragraphtype"] == 2){
        checkForValue($_POST["sectionid"],filter_var($_POST["sectionid"],FILTER_VALIDATE_INT),"Wrong / No Value for section Number","/api/paragraph/uploadparagraph.html.php");
        $sectionid = (empty($_POST["sectionid"])? 0 :  ($_POST["sectionid"]));

        $sectionparagraphid = (empty($_POST["sectionparagraphid"])? 0 :  ($_POST["sectionparagraphid"]));

        if($paragraph->editSectionParagraph($sectionparagraphid,$title,$paragraphtext,$paragraphigbotext,$paragraphannotation,$sectionid)){
            $output = "Paragraph successfully edited";
            header("Location: /api/paragraph/section.html.php?output=".$output);
            exit;
        }

    }elseif($_POST["paragraphtype"] == 1){
        checkForValue($_POST["title"],filter_var($_POST["title"],FILTER_SANITIZE_STRING),"Wrong / No Value for Section Title","/api/paragraph/uploadparagraph.html.php");
        $sectionid = (empty($_POST["sectionid"])? 0 :  ($_POST["sectionid"]));

        if($paragraph->editSection($sectionid,$title,$paragraphtext,$paragraphigbotext,$paragraphannotation)){
            $output = "Paragraph successfully published";
            header("Location: /api/paragraph/section.html.php?output=".$output);
            exit;
        }
    }else{
        $error = "Paragraph not published , Try Again";
        require_once $_SERVER["DOCUMENT_ROOT"]."/api/paragraph/uploadparagraph.html.php";
        exit;
    }
}
?>