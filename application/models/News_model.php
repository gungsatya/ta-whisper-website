<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function get_current_page_records($category, $limit, $start, $keyword)
    {
        if($category == "" || $category == "semua") {
            $this->db->select('id, news_url, title, category, url_img, banner_img, LEFT(content, 50) as content, created_at');
            $this->db->like('title', $keyword);
            $this->db->limit($limit, $start);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get("news");
        } else {
            $this->db->select('id, news_url, title, category, url_img, banner_img, LEFT(content, 50) as content, created_at');
            $this->db->like('title', $keyword);
            $this->db->limit($limit, $start);
            $this->db->where('category', $category);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get("news");
        }
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    public function get_total($category, $keyword)
    {
        if($category == "" || $category == "semua") {
            $this->db->like('title', $keyword);
            return $this->db->count_all_results("news");
        } else {
            $this->db->from('news');
            $this->db->where('category', $category);
            $this->db->like('title', $keyword);
            return $this->db->count_all_results();
        }
    }
    public function add($data)
    {
        try {
            $this->db->insert('news', $data);
            $id = $this->db->insert_id();
            return $id;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function update($id, $data)
    {
        try {
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('news');
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function get_by_url($url)
    {
        try {
            $this->db->where('news_url', $url);
            return $this->db->get('news')->row_array();
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function delete_by_id($id)
    {
        try {
            $this->db->where('id', $id);
            $this->db->delete('news');
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function get_by_id($id)
    {
        try {
            $this->db->where('id', $id);
            return $this->db->get('news')->row_array();
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function get_rand()
    {
        try {
            $this->db->order_by('rand()');
            $this->db->limit(5);
            return $this->db->get('news')->result();
        }
        catch(Exception $e) {
            return false;
        }
    }
    public function get_by_limit($limit = '')
    {
        try {
            if($limit == '') {
                $this->db->order_by('id', 'desc');
                $this->db->limit(3);
                $query = $this->db->get('news');
                if($query->num_rows() > 0) {
                    foreach($query->result() as $row) {
                        $data[] = $row;
                    }
                    return $data;
                }
                return false;
            } else {
                $this->db->where('id <', $limit);
                $this->db->order_by('id', 'desc');
                $this->db->limit(3);
                $query = $this->db->get('news');
                if($query->num_rows() > 0) {
                    foreach($query->result() as $row) {
                        $data[] = $row;
                    }
                    return $data;
                }
                return false;
            }
        }
        catch(Exception $e) {
            return false;
        }
    }
}