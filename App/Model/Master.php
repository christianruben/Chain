<?php

namespace App\Model;
use System\Model as Model;

class Master extends Model{
    public function insertLocation($locname){
        $fields = array("location_name");
        $values = array($locname);
        $loc = $this->db->insert("tbl_location", $fields, $values);
        if($loc){
            return true;
        }else{
            return false;
        }
    }
    
    public function updateLocation($id, $locname){
        $fields = array("location_name");
        $values = array($locname);
        $loc = $this->db->update("tbl_location", $fields, $values, "id = $id");
        if($loc){
            return true;
        }else{
            return false;
        }
    }

    public function deleteLocation($id){
        return $this->db->delete("tbl_location", "id = ?", array($id));
    }

    public function showLocation($search, $sort, $sortby, $index, $rows){
        $query = "";
        $values = array();
        if(trim($search) != ""){
            $src = "%".trim($search)."%";
            $query = "location_name LIKE ? ORDER BY $sortby $sort LIMIT $index,$rows";
            $values = array($src);
        }else{
            $query = "ORDER BY $sortby $sort LIMIT $index,$rows";
        }
        $location = $this->db->select("tbl_location", $query, $values);
        return $location;
    }

    public function insertSubLocation($idloc, $sublocname){
        $fields = array("id_location", "sublocation_name");
        $values = array($idloc, $sublocname);
        $loc = $this->db->insert("tbl_sublocation", $fields, $values);
        if($loc){
            return true;
        }else{
            return false;
        }
    }
    
    public function updateSubLocation($id, $idloc, $sublocname){
        $fields = array("id_location", "sublocation_name");
        $values = array($idloc, $sublocname);
        $loc = $this->db->update("tbl_sublocation", $fields, $values, "id = $id");
        if($loc){
            return true;
        }else{
            return false;
        }
    }

    public function deleteSubLocation($id){
        return $this->db->delete("tbl_sublocation", "id = ?", array($id));
    }

    public function showSubLocation($search, $sort, $sortby, $index, $rows){
        $query = "";
        $values = array();
        if(trim($search) != ""){
            $src = "%".trim($search)."%";
            $values = array($src, $src);
            $query = "SELECT * FROM tbl_sublocation as tsl INNER JOIN tbl_location as tl ON tsl.id_location = tl.id WHERE tl.location_name LIKE ? OR tsl.sublocation_name LIKE ? ORDER BY $sortby $sort LIMIT $index,$rows";
        }else{
            $query = "SELECT * FROM tbl_sublocation as tsl INNER JOIN tbl_location as tl ON tsl.id_location = tl.id ORDER BY $sortby $sort LIMIT $index,$rows";
        }
        $sublocation = $this->db->rawQuery($query, $values);
        return $location;
    }
    
    public function insertArea($idsubloc, $areaname){
        $fields = array("id_sublocation", "area_name");
        $values = array($idsubloc, $areaname);
        $loc = $this->db->insert("tbl_area", $fields, $values);
        if($loc){
            return true;
        }else{
            return false;
        }
    }
    
    public function updateArea($id, $idsubloc, $areaname){
        $fields = array("id_sublocation", "area_name");
        $values = array($idsubloc, $areaname);
        $loc = $this->db->update("tbl_area", $fields, $values, "id = $id");
        if($loc){
            return true;
        }else{
            return false;
        }
    }

    public function deleteArea($id){
        return $this->db->delete("tbl_area", "id = ?", array($id));
    }

    public function showArea($search, $sort, $sortby, $index, $rows){
        $query = "";
        $values = array();
        if(trim($search) != ""){
            $src = "%".trim($search)."%";
            $values = array($src, $src);
            $query = "SELECT * FROM tbl_area as ta INNER JOIN tbl_sublocation as tsl ON tsl.id = ta.id_sublocation INNER JOIN tbl_location as tl ON tsl.id_location = tl.id WHERE tl.location_name LIKE ? OR tl.sublocation_name LIKE ? OR tsl.sublocation_name LIKE ? ORDER BY $sortby $sort LIMIT $index,$rows";
        }else{
            $query = "SELECT * FROM tbl_area as ta INNER JOIN tbl_sublocation as tsl ON tsl.id = ta.id_sublocation INNER JOIN tbl_location as tl ON tsl.id_location = tl.id ORDER BY $sortby $sort LIMIT $index,$rows";
        }
        $sublocation = $this->db->rawQuery($query, $values);
        return $location;
    }

    public function insertSubArea($idarea, $subareaname){
        $fields = array("id_area", "area_name");
        $values = array($idarea, $subareaname);
        $loc = $this->db->insert("tbl_subarea", $fields, $values);
        if($loc){
            return true;
        }else{
            return false;
        }
    }
    
    public function updateSubArea($id, $idarea, $subareaname){
        $fields = array("id_area", "area_name");
        $values = array($idarea, $subareaname);
        $loc = $this->db->update("tbl_subarea", $fields, $values, "id = $id");
        if($loc){
            return true;
        }else{
            return false;
        }
    }

    public function deleteSubArea($id){
        return $this->db->delete("tbl_subarea", "id = ?", array($id));
    }

    public function showSubArea($search, $sort, $sortby, $index, $rows){
        $query = "";
        $values = array();
        if(trim($search) != ""){
            $src = "%".trim($search)."%";
            $values = array($src, $src);
            $query = "SELECT * FROM tbl_subarea as tsa INNER JOIN tbl_area as ta ON tsa.id_area = ta.id INNER JOIN tbl_sublocation as tsl ON tsl.id = ta.id_sublocation INNER JOIN tbl_location as tl ON tsl.id_location = tl.id WHERE tl.location_name LIKE ? OR tl.sublocation_name LIKE ? OR ta.area_name LIKE ? OR tsa.subarea_name LIKE ? ORDER BY $sortby $sort LIMIT $index,$rows";
        }else{
            $query = "SELECT * FROM tbl_subarea as tsa INNER JOIN tbl_area as ta ON tsa.id_area = ta.id INNER JOIN tbl_sublocation as tsl ON tsl.id = ta.id_sublocation INNER JOIN tbl_location as tl ON tsl.id_location = tl.id ORDER BY $sortby $sort LIMIT $index,$rows";
        }
        $sublocation = $this->db->rawQuery($query, $values);
        return $location;
    }

    public function getLocation(){
        $loc = $this->db->select("tbl_location", "ORDER BY id", array());
        return $loc;
    }

    public function getSubLocation($idloc){
        $subloc = $this->db->select("tbl_sublocation", "id_location = ? ORDER BY id", array($idloc));
        return $subloc;
    }

    public function getArea($idsubloc){
        $area = $this->db->select("tbl_area", "id_sublocation = ? ORDER BY id", array($idsubloc));
        return $area;
    }

    public function getSubArea($idarea){
        $subarea = $this->db->select("tbl_subarea", "id_area = ? ORDER BY id", array($idarea));
        return $subarea;
    }
}