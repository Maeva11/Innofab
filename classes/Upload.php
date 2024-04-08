<?php

class Upload
{
    private $TARGET = 'themes/assets/upload/';    // Repertoire cible
    private $MAX_SIZE = 10000000;    // Taille max en octets du fichier
    private $WIDTH_MAX = 5500;        // Largeur max de l'image en pixels
    private $HEIGHT_MAX = 5500;        // Hauteur max de l'image en pixels
    // Tableaux de donnees
    private $tabExt = array('jpg', 'gif', 'png', 'jpeg', 'pdf', 'svg', 'jfif');    // Extensions autorisees
    private $infosImg = array();
    // Variables
    private $extension = '';
    private $message = '';
    private $new_name = '';
    public function upload_image($files, $chemin = '../', $name = 'image')
    {
        // On verifie si le champ est rempli
        if (!empty($files[$name]['name'])) {
            // Recuperation de l'extension du fichier
            $extension = pathinfo($files[$name]['name'], PATHINFO_EXTENSION);
            // On verifie l'extension du fichier
            if (in_array(strtolower($extension), $this->tabExt)) {
                // On recupere les dimensions du fichier
                $this->infosImg = getimagesize($files[$name]['tmp_name']);
                // On verifie le type de l'image
                if ($this->infosImg[2] >= 1 && $this->infosImg[2] <= 14) {
                    // On verifie les dimensions et taille de l'image
                    if (($this->infosImg[0] <= $this->WIDTH_MAX) && ($this->infosImg[1] <= $this->HEIGHT_MAX) && (filesize($files[$name]['tmp_name']) <= $this->MAX_SIZE)) {
                        // Parcours du tableau d'erreurs
                        if (isset($files[$name]['error']) && UPLOAD_ERR_OK === $files[$name]['error']) {
                            // On renomme le fichier
                            $new_name = md5(uniqid()) . '.' . $extension;
                            // Si c'est OK, on teste l'upload
                            if (move_uploaded_file($files[$name]['tmp_name'], DIRNAME(__FILE__) . '/' . $chemin . $this->TARGET . $new_name)) {
                                return '/' . $this->TARGET . $new_name;
                            } else {
                                $message = 'Problème lors de l\'upload !';
                            }
                        } else {
                            $message = 'Une erreur interne a empêché l\'uplaod';
                        }
                    } else {
                        // Sinon erreur sur les dimensions et taille de l'image
                        $message = 'Erreur dans les dimensions de l\'image !';
                        if (!($this->infosImg[0] <= $this->WIDTH_MAX)) $message .= "<br/>Trop large";
                        if (!($this->infosImg[1] <= $this->HEIGHT_MAX)) $message .= "<br/>Trop haut";
                        if (!(filesize($files[$name]['tmp_name']) <= $this->MAX_SIZE)) $message .= "<br/>Trop gros max:" . $this->MAX_SIZE . " taille:" . filesize($files[$name]['tmp_name']);
                    }
                } else {
                    // Sinon erreur sur le type de l'image
                    $message = 'Le fichier à uploader n\'est pas une image !';
                }
            } else {
                // Sinon on affiche une erreur pour l'extension
                $message = 'L\'extension du fichier est incorrecte !';
            }
        }
        return false;
    }

    public function upload_file($files, $chemin = '../', $name = 'doc')
    {
        // On verifie si le champ est rempli
        if (!empty($files[$name]['name'])) {
            // Recuperation de l'extension du fichier
            $extension = pathinfo($files[$name]['name'], PATHINFO_EXTENSION);

            // On verifie l'extension du fichier
            if (in_array(strtolower($extension), $this->tabExt)) {
                // On verifie la taille du fichier
                if ($files[$name]['size'] >= 1 && $files[$name]['size'] <= 15000000) {
                    // Parcours du tableau d'erreurs
                    if (isset($files[$name]['error']) && UPLOAD_ERR_OK === $files[$name]['error']) {
                        // On renomme le fichier
                        $new_name = rand() . date('mdHis') . '_' . Tools::slug_file($files[$name]['name']);//md5(uniqid()) .'.'. $extension;
                        // Si c'est OK, on teste l'upload
                        if (move_uploaded_file($files[$name]['tmp_name'], DIRNAME(__FILE__) . '/' . $chemin . $this->TARGET . $new_name)) {
                            if (file_exists(DIRNAME(__FILE__) . '/' . $chemin . $this->TARGET . $new_name)) {
                                echo "Le fichier a été correctement déplacé.";
                            } else {
                                echo "Erreur lors du déplacement du fichier.";
                            }
                        } else {
                            echo "Problème lors de l'upload !";
                        }
                    } else {
                        $message = 'Une erreur interne a empêché l\'uplaod';
                    }

                } else {
                    // Sinon erreur sur le type de l'image
                    $message = 'Le fichier à uploader est trop lourd !';
                }
            } else {
                // Sinon on affiche une erreur pour l'extension
                $message = 'L\'extension du fichier est incorrecte !';
            }
        }
        return false;
    }
}