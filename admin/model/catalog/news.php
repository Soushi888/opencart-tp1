<?php
class ModelCatalogNews extends Model
{
    public function addNew($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news SET id_new = '" . (int)$data['id_new'] . "', title = '" . $this->db->escape(strip_tags($data['title'])) . "', news = '" . $data['news'] . "', author = '" . $data['author'] . "'");

        $id_new = $this->db->getLastId();

		$this->cache->delete('new');

		return $id_new;
	}

    public function editNew($id_new, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "news SET title = '" . $this->db->escape(strip_tags($data['title'])) . "', news = '" . $data['news'] . "', author = '" . $data['author'] . "' WHERE id_new = '" . $id_new . "'");

		$this->cache->delete('news');
	}

	public function deleteNew($id_new) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news WHERE id_new = '" . (int)$id_new . "'");

		$this->cache->delete('new');
    }
    
    public function getNews()
    {
		$sql = "SELECT * FROM " . DB_PREFIX . "news";
        
        $query = $this->db->query($sql);

		return $query->rows;
	}
	
	public function getNew($id_news)
    {
        //EXECUTER REQUETE ->  DB_PREFIX option d'opencart il sera oc_
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news WHERE id_new = '" . $id_news . "'");

        //verifie tous les id si corespon donne l'id en question.
        if ($query->num_rows) {
            return $query->row;
        } else {
            return false;
        }
    }
}