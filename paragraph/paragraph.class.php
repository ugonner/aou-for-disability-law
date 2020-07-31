<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/db/connect2.php";
class Paragraph{
    protected $dbcc;
    //protected $dbc = new Dbconn();
    //protected $dbcc = $this->dbc->dbcon;

    public function __construct(){
        $dbc = new Dbconn();
        $this->dbcc = $dbc->dbcon;
    }

    public function getLaw(){
        $sections = $this->getSections(0,0,0);
        $sectionparagraphs = $this->getSectionParagraphs(0,0,0);
        $subsectionparagraphs = $this->getSubSectionParagraphs(0,0,0);

        if((!empty($sections))&&(!empty($sectionparagraphs))){
            //sorting section's subsections
            for($i=0; $i<count($sections); $i++){
                for($j=0; $j<count($sectionparagraphs); $j++){
                    if($sectionparagraphs[$j]['sectionid'] == $sections[$i]['id']){
                        $sections[$i]["subsections"][] = $sectionparagraphs[$j];
                    }
                }
            }

            //sorting subsection's paragraphs'
            if(!empty($subsectionparagraphs)){
                if(!empty($sections)){
                    for($k=0; $k<count($sections); $k++){
                        if(!empty($sections[$k]["subsections"])){
                            for($l=0; $l<count($sections[$k]["subsections"]); $l++){
                                for($m=0; $m<count($subsectionparagraphs); $m++){
                                    $section_subsections = $sections[$k]["subsections"][$l];
                                    $subsection_p = $subsectionparagraphs[$m];
                                    if(($section_subsections["sectionid"] == $subsection_p["sectionid"])&&($section_subsections["subsectionno"] == $subsection_p["subsectionid"])){
                                        $sections[$k]["subsections"][$l]["paragraphs"][] = $subsection_p;
                                    }
                                }
                            }
                        }
                    }
                }
            }

            /*for($k=0; $k<count($sections); $k++){
                for($l=0; $l<count($sections[$k]["subsections"]); $l++){
                    for($m=0; $m<count($subsectionparagraphs); $m++){
                        $section_subsections = $sections[$k]["subsections"][$l];
                        $subsection_p = $subsectionparagraphs[$m];
                        if(($section_subsections["sectionid"] == $subsection_p["sectionid"])&&($section_subsections["id"] == $subsection_p["subsectionid"])){
                            $section_subsections["paragraphs"][] = $subsection_p;
                        }
                    }
                }
            }*/

            return array("sections"=>$sections, "sectionparagraphs"=>$sectionparagraphs, "subsectionparagraphs"=>$subsectionparagraphs);
        }
        return false;
    }

    public function getSection($sectionid){
        $sections = $this->getSections("id=".$sectionid,0,0);
        $sectionparagraphs = $this->getSectionParagraphs("sectionid = ".$sectionid,0,0);
        $subsectionparagraphs = $this->getSubSectionParagraphs("sectionid = ".$sectionid,0,0);

        if(!empty($sections)){
            return array("sections"=>$sections, "sectionparagraphs"=>$sectionparagraphs, "subsectionparagraphs"=>$subsectionparagraphs);
        }
        return false;
    }

    public function getSections($whereclause,$amtperpage,$pgn){
        //if amount per page is null or 0 then no limit; fetch all
        if(empty($amtperpage)){
            $limit_sql =  " ";
        }else{
            //if page no == 0 / null limit is amount per page
            $limit = (empty($pgn) ? $amtperpage : ($amtperpage*$pgn));
            $limit_sql =$pgn ." , ".$limit;
        }

        $wq = (empty($whereclause)? '1=1' : $whereclause);

        //$sql = "SELECT id, title, paragraphtext, paragraphigbotext, paragraphannotation FROM section ORDER BY id ASC ". $limit_sql;

        $sql = "SELECT id, title, paragraphtext, paragraphigbotext, paragraphannotation
         FROM section
         WHERE ".$wq."
         ORDER BY id ASC ". $limit_sql;

        try{
            $stmt = $this->dbcc->prepare($sql);
            $stmt->execute();
            $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rowcount = $stmt->rowCount();
            //echo($rowcount ." ".$sections[0]["title"]); exit;
            if($rowcount > 0){
                return $sections;
            }

        }catch (PDOException $e){
            $error = $e->getMessage();
            $error2 = "SQL ERROR: unable to get sections";
            include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/error/error.html.php";
            exit;
        }
        return false;
    }

    public function getSectionParagraphs($whereclause,$amtperpage,$pgn){
        //if amount per page is null or 0 then no limit; fetch all
        if(empty($amtperpage)){
            $limit_sql =  " ";
        }else{
            //if page no == 0 / null limit is amount per page
            $limit = (empty($pgn) ? $amtperpage : ($amtperpage*$pgn));
            $limit_sql =$pgn ." , ".$limit;
        }

        $wq = (empty($whereclause)? '1=1' : $whereclause);

        $sql = "SELECT id, title, paragraphtext, paragraphigbotext, paragraphannotation, sectionid, subsectionno
         FROM sectionparagraph
         WHERE ".$wq."
         ORDER BY id ASC ". $limit_sql;

        try{
            $stmt = $this->dbcc->prepare($sql);
            $stmt->execute();
            $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rowcount = $stmt->rowCount();
            if(count($sections)>0){
                return $sections;
            }

        }catch (PDOException $e){
            $error = $e->getMessage();
            $error2 = "SQL ERROR: unable to get sections";
            include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/error/error.html.php";
            exit;
        }
        return false;
    }

    public function getSubSectionParagraphs($whereclause,$amtperpage,$pgn){
        //if amount per page is null or 0 then no limit; fetch all
        if(empty($amtperpage)){
            $limit_sql =  " ";
        }else{
            //if page no == 0 / null limit is amount per page
            $limit = (empty($pgn) ? $amtperpage : ($amtperpage*$pgn));
            $limit_sql =$pgn ." , ".$limit;
        }

        $wq = (empty($whereclause)? '1=1' : $whereclause);



        /*$sql = "SELECT subsectionparagraph.id AS subsectionparagraphid, subsectionparagraph.title AS subsectionparagraphtitle,
         subsectionparagraph.paragraphtext AS subsectionparagraphparagraphtext,
         subsectionparagraph.paragraphigbotext AS subsectionparagraphparagraphigbotext, subsectionparagraph.paragraphannotation AS subsectionparagraphparagraphannotation,
         subsectionparagraph.sectionid AS subsectionparagraphsectionid
         FROM subsectionparagraph
         WHERE ".$wq."
         ORDER BY id ASC ". $limit_sql;*/

        $sql = "SELECT id, title, paragraphtext, paragraphigbotext, paragraphannotation, sectionid, subsectionid
         FROM subsectionparagraph
         WHERE ".$wq."
         ORDER BY id ASC ". $limit_sql;

        try{
            $stmt = $this->dbcc->prepare($sql);
            $stmt->execute();
            $sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $rowcount = $stmt->rowCount();
            if($rowcount>0){
                return $sections;
            }

        }catch (PDOException $e){
            $error = $e->getMessage();
            $error2 = "SQL ERROR: unable to get sections";
            include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/error/error.html.php";
            exit;
        }
        return false;
    }

    public function addSection($title,$paragraphtext,$paragraphigbotext,$paragraphannotation){
        $sql = 'INSERT INTO section (title,paragraphtext,paragraphigbotext,paragraphannotation)
                VALUES (:title,:paragraphtext,:paragraphigbotext,:paragraphannotation)';

        try{
            $stmt = $this->dbcc->prepare($sql);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":paragraphtext", $paragraphtext);
            $stmt->bindParam(":paragraphigbotext", $paragraphigbotext);
            $stmt->bindParam(":paragraphannotation", $paragraphannotation);

            $stmt->execute();
            $rowcount = $stmt->rowCount();
            if($rowcount>0){
                return true;
            }
        }catch (PDOException $e){
            $error2 = "unable to add section";
            $error = $e->getMessage();
            include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/error/error.html.php";
            exit;
        }

        return false;
    }

    public function addSectionParagraph($title,$paragraphtext,$paragraphigbotext,$paragraphannotation,$sectionid,$subsectionno){
        $sql = 'INSERT INTO sectionparagraph (title,paragraphtext,paragraphigbotext,paragraphannotation,sectionid,subsectionno)
                VALUES (:title,:paragraphtext,:paragraphigbotext,:paragraphannotation,:sectionid,:subsectionno)';

        try{
            $stmt = $this->dbcc->prepare($sql);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":paragraphtext", $paragraphtext);
            $stmt->bindParam(":paragraphigbotext", $paragraphigbotext);
            $stmt->bindParam(":paragraphannotation", $paragraphannotation);
            $stmt->bindParam(":sectionid", $sectionid);
            $stmt->bindParam(":subsectionno", $subsectionno);

            $stmt->execute();
            $rowcount = $stmt->rowCount();
            if($rowcount>0){
                return true;
            }
        }catch (PDOException $e){
            $error2 = $e->getMessage();
            $error = "unable to add sectionparagraph";
            include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/error/error.html.php";
            exit;
        }

        return false;
    }

    public function addSubSectionParagraph($title,$paragraphtext,$paragraphigbotext,$paragraphannotation,$sectionid,$subsectionid){
        $sql = 'INSERT INTO subsectionparagraph (title,paragraphtext,paragraphigbotext,paragraphannotation,sectionid,subsectionid)
                VALUES (:title,:paragraphtext,:paragraphigbotext,:paragraphannotation,:sectionid, :subsectionid)';

        try{
            $stmt = $this->dbcc->prepare($sql);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":paragraphtext", $paragraphtext);
            $stmt->bindParam(":paragraphigbotext", $paragraphigbotext);
            $stmt->bindParam(":paragraphannotation", $paragraphannotation);
            $stmt->bindParam(":sectionid", $sectionid);
            $stmt->bindParam(":subsectionid", $subsectionid);

            $stmt->execute();
            $rowcount = $stmt->rowCount();
            if($rowcount>0){
                return true;
            }
        }catch (PDOException $e){
            $error = $e->getMessage();
            include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/error/error.html.php";
            exit;
        }

        return false;
    }

    public function editSubSectionParagraph($subsectionparagraphid,$title,$paragraphtext,$paragraphigbotext,$paragraphannotation,$sectionid,$subsectionid){
        $sql = 'UPDATE subsectionparagraph SET
                title = :title,
                paragraphtext = :paragraphtext,
                paragraphigbotext = :paragraphigbotext,
                paragraphannotation = :paragraphannotation,
                sectionid = :sectionid,
                subsectionid = :subsectionid
                WHERE id = :subsectionparagraphid';

        try{
            $stmt = $this->dbcc->prepare($sql);
            $stmt->bindParam(":subsectionparagraphid", $subsectionparagraphid);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":paragraphtext", $paragraphtext);
            $stmt->bindParam(":paragraphigbotext", $paragraphigbotext);
            $stmt->bindParam(":paragraphannotation", $paragraphannotation);
            $stmt->bindParam(":sectionid", $sectionid);
            $stmt->bindParam(":subsectionid", $subsectionid);

            $stmt->execute();
            $rowcount = $stmt->rowCount();
            if($rowcount>0){
                return true;
            }
        }catch (PDOException $e){
            $error = $e->getMessage();
            $error2 = "unable to edit sub-section paragraph";
            include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/error/error.html.php";
            exit;
        }

        return false;
    }

    public function editSectionParagraph($sectionparagraphid,$title,$paragraphtext,$paragraphigbotext,$paragraphannotation,$sectionid){
        $sql = 'UPDATE sectionparagraph SET
                title = :title,
                paragraphtext = :paragraphtext,
                paragraphigbotext = :paragraphigbotext,
                paragraphannotation = :paragraphannotation,
                sectionid = :sectionid
                WHERE id = :sectionparagraphid';

        try{
            $stmt = $this->dbcc->prepare($sql);
            $stmt->bindParam(":sectionparagraphid", $sectionparagraphid);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":paragraphtext", $paragraphtext);
            $stmt->bindParam(":paragraphigbotext", $paragraphigbotext);
            $stmt->bindParam(":paragraphannotation", $paragraphannotation);
            $stmt->bindParam(":sectionid", $sectionid);

            $stmt->execute();
            $rowcount = $stmt->rowCount();
            if($rowcount>0){
                return true;
            }
        }catch (PDOException $e){
            $error = $e->getMessage();
            $error2 = "unable to edit section-paragraph";
            include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/error/error.html.php";
            exit;
        }

        return false;
    }
    public function editSection($sectionid,$title,$paragraphtext,$paragraphigbotext,$paragraphannotation){
        $sql = 'UPDATE section SET
                title = :title,
                paragraphtext = :paragraphtext,
                paragraphigbotext = :paragraphigbotext,
                paragraphannotation = :paragraphannotation
                WHERE id = :sectionid';

        try{
            $stmt = $this->dbcc->prepare($sql);
            $stmt->bindParam(":sectionid", $sectionid);
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":paragraphtext", $paragraphtext);
            $stmt->bindParam(":paragraphigbotext", $paragraphigbotext);
            $stmt->bindParam(":paragraphannotation", $paragraphannotation);

            $stmt->execute();
            $rowcount = $stmt->rowCount();
            if($rowcount>0){
                return true;
            }
        }catch (PDOException $e){
            $error = $e->getMessage();
            $error2 = "unable to edit section";
            include_once $_SERVER["DOCUMENT_ROOT"]."/api/includes/error/error.html.php";
            exit;
        }

        return false;
    }



}
?>