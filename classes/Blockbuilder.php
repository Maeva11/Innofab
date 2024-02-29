<?php


class Blockbuilder extends Controller
{
    protected $table;
    public $db;

    public function __construct()
    {
        parent::__construct();
        $this->table = parent::getModel()->setTable(DB_PREFIX . 'block');
        $this->db = parent::getModel()->getDb();
    }

    public function generateBlock($id, $datas, $pagename, $app, $dPage)
    {
        $block = $this->getBy(['id' => $id])[0];
        echo "<!--$block->nom-->";
        if (@$block->crud) { include('themes/blocks/' . $block->crud_block . ".php"); }
        $structure = @$block->{"structure"._PREFIX_LANG_};

        if (@$block->duplicable) {
            $etat = preg_match("/<duplicate>(.*)<\/duplicate>/s", $structure, $duplicable);
            if (!$etat && $structure == "") { return "N'oubliez pas les balises de duplication !"; }
            $html = "";
            foreach ($datas as $data) {
                $generate = $duplicable[1];
                foreach ($data as $var => $data) {
                    $generate = str_replace(["<slug>[[$var]]</slug>"], [@Tools::slug($data)], $generate);
                    $generate = str_replace(["[!$var]]", "[[$var!]", "[[$var]]"], ["", "", @$data], $generate);
                }
                $html .= $generate;
            }
            if ($etat) {
                $html = preg_replace("/<duplicate>(.*)<\/duplicate>/s", $html, $structure);
            }
            foreach (json_decode((new Admin())->getBy(["block" => "configuration"])[0]->datas) as $el) {
                $html = str_replace("#CONFIG::$el->label#", $el->value, $html);
            }
            foreach(json_decode($block->datas) as $block_var) {
                preg_match("/\[!" . $block_var->name . "]](.*?)\[\[" . $block_var->name . "!]/s", $html, $matches);
                foreach ($matches[0] as $match)
                    $html = str_replace($match, '', $html);
            }

            $html = str_replace(['#IMG_DIR#', '#PAGE_NAME#'], [IMG_DIR, $pagename], $html);
            return $html;
        } else {
            foreach ($datas as $data) {
                foreach ($data as $var => $data) {
                    $structure = str_replace(["<slug>[[$var]]</slug>"], [@Tools::slug($data)], $structure);
                    $structure = str_replace(["[!$var]]", "[[$var!]", "[[$var]]"], ["", "", @$data], $structure);
                }
                foreach (json_decode((new Admin())->getBy(["block" => "configuration"])[0]->datas) as $el) {
                    $structure = str_replace("#CONFIG::$el->label#", $el->value, $structure);
                }

            }

            foreach(json_decode($block->datas) as $block_var){
                preg_match_all("/\[!".$block_var->name."]](.*?)\[\[".$block_var->name."!]/", $structure, $matches);
                $structure = str_replace($matches, '', $structure);
                foreach ($matches[0] as $match)
                    $structure = str_replace($match, '', $structure);
            }

            return str_replace(['#IMG_DIR#', '#PAGE_NAME#', '<strong>', '</strong>'], [IMG_DIR, $pagename, '<span>', '</span>'], $structure);
        }
    }
}
