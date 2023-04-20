<?php

/////////////////////////////////////////////////////////////////////
//
//     this is the xml operation class of guestbook
//
//     last modify was on 2021-12-27
//
/////////////////////////////////////////////////////////////////////

class xml_opration{


    var $string;
    var $data;
    var $filename;
    var $xml;
    var $size;
    //var $string;
   // var $size;
    var $total;


    //define xml file's name
    //get the file and put it into string
    function __construct() {
        $this->filename = "concerts.xml";
        $this->xml = file_get_contents($this->filename);
        $this->size = RECORD_DISPLAY_COUNT;
    }


    //get xml file and return count of array
    function xmlFormat(){
        $parser = xml_parser_create();
        xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
        xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
        xml_parse_into_struct($parser,$this->xml,$values,$tags);
        xml_parser_free($parser);
        $this->total = intval(count($values)/6);
        //echo $this->total;
        //print_r($values);
    }


    //display records for appointed count
    function xmlPartFormat($page,$pagecount){
        if ($page == 1)
            $this->xml = preg_replace("/(.*)<concert id=\"".($this->total-RECORD_DISPLAY_COUNT)."\">.*$/isU", "\\1</root>", $this->xml);
        elseif($page == $pagecount)
            $this->xml = preg_replace("/(.*)(<concert id=\"".($this->total-RECORD_DISPLAY_COUNT*($page-1))."\">.*$)/isU", "<?xml version='1.0' encoding=\"gb2312\"?>\n<root>\\2", $this->xml);
        else{
            $this->xml = preg_replace("/(.*)(<concert id=\"".($this->total-RECORD_DISPLAY_COUNT*($page-1))."\">.*<concert id=\"".($this->total-RECORD_DISPLAY_COUNT*($page-1)-(RECORD_DISPLAY_COUNT-1))."\">.*<\/concert>).*$/isU", "<?xml version=\"1.0\"?>\n<root>\\2\n</root>", $this->xml);
        }
        /* var_dump($this->xml); */

        // to test above preg_replace function
        //and allow browser to see rss
        //BEGIN
        $fp = fopen (RSS_FILENAME, "w+");
        fwrite($fp, $this->xml);
        fclose ($fp);
        //END
        //
        $parser = xml_parser_create();
        xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
        xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
        xml_parse_into_struct($parser,$this->xml,$values,$tags);
        xml_parser_free($parser);
        /* var_dump($values); */
        return $values;
    }


    //format some tags that can not red and write in xm file
    function formatXmlString($string){
        $trans = array("&" => "&amp;", ">" => "&gt;", "<" => "&lt;", "\"" => "&quot;", "'" => "&apos;");
        $this->string = strtr($string, $trans);
        return $this->string;
    }


    //insert xml file
    function insertXmlFile($id, $tickets, $date, $country, $town, $center){
        $this->xml = preg_replace("/^.*<root>/is", "", $this->xml);

        Header("Content-type:text/xml");
        $this->data = "<?xml version=\"1.0\"?>\n";
        $this->data.= "<root>\n";
        $this->data.= "<concert id=\"".$id."\">\n";
        $this->data.= "<tickets>".$tickets."</tickets>\n";
        $this->data.= "<date>".$date."</date>\n";
        $this->data.= "<country>".$country."</country>\n";
        $this->data.= "<town>".$town."</town>\n";
        $this->data.= "<center>".$center."</center>\n";
        $this->data.= "</concert>";
        $this->data.=$this->xml;
    }


    //update xml file
    function updateXmlFile($id, $tickets, $date, $country, $town, $center){
        $this->data = preg_replace("/<concert id=\"".$id."\">.*<\/center>/isU",
                "<concert id=\"".$id."\">\n<tickets>".$tickets."</tickets>\n<date>".$date."</date>\n<country>".$country."</country>\n<town>".$town."</town>\n<center>".$center."</center>", $this->xml);
    }


    //delete xml file
    function deleteXmlFile($id){
        $this->data = preg_replace("/<concert id=\"".$id."\">.*<\/concert>.*(<concert id=\"".($id-1)."\">)/isU", "\\1", $this->xml);
    }


    //write in guestbook.xml
    function writeXmlFile(){
        $fp = fopen ($this->filename, "w+");
        fwrite($fp, $this->data);
        fclose ($fp);
    }


    //pagenite function
    //when record count exceed max display counts of a page ,it will be valid
    //and it return some global variables
    function page(){
        global $begin,$pagesize,$pagecount,$total,$pagestring,$page;
        if( isset($_GET['page']) ){
           $page = intval($_GET['page'] );
        }
        else
           $page = 1;

       $total = $this->total;
       $pagesize = $this->size;
       if ($total){
          if ($total<$pagesize)
             $pagecount=1;
          if ($total%$pagesize)
             $pagecount=(int)($total/$pagesize)+1;
          else $pagecount=$total/$pagesize;
        }
        else $pagecount=0;
        $pagestring="";
        $select="";
        if ($page==1)
           $pagestring.= FIRST_PAGE.SPACER.PREVIEW_PAGE.SPACER;
        else
           $pagestring.="<a href=?page=1>".FIRST_PAGE."</a>".SPACER."<a href=?page=".($page-1).">".PREVIEW_PAGE."</a>".SPACER;
        if ($page==$pagecount or $pagecount==0)
           $pagestring.= NEXT_PAGE.SPACER.LAST_PAGE;
        else
            $pagestring.="<a href=?page=".($page+1).">".NEXT_PAGE."</a>".SPACER."<a href=?page=".($pagecount).">".LAST_PAGE."</a>";
        $begin=$page*$pagesize;
     }
}

?>
