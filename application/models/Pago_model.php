<?php

class Pago_model extends CI_Model
{
    public function getPaises(){
        $result = array(""=>"");
        $query = $query = $this->db->get('paises');
        foreach ($query->result() as $item) {
            $result[$item->id] = $item->name;
        }
        return $result;
    }

    public function setSolicitud($data){
        $this->db->insert("solicitudes",$data);
        return $this->db->insert_id();
    }

    public function setDetalleSolicitud($data){
        $this->db->insert("detalle_solicitud",$data);
        return $this->db->insert_id();
    }

    public function updateSolicitud($data,$id){
        $this->db->where('id',$id);
        return $this->db->update("solicitudes",$data);

    }

    public function getSolicitud($token){
        $query = $this->db->get_where('solicitudes', array('token' => $token));
        return $query->result_array();
    }

    public function getNombrePais($id){
        $query = $this->db->get_where('paises', array('id' => $id));
        $result = $query->result_array();
        return $result[0]["name"];
    }

    public function getDetalleSolicitud($id){
        $query = $this->db->get_where('detalle_solicitud', array('solicitud_id' => $id));
        return $query->result_array();
    }

}