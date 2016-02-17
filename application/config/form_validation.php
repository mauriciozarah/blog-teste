<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
		"login" => array(
			array(
				"field" => "email",
				"label" => "E-mail",
				"rules" => "required|valid_email|xss_clean|min_length[3]|max_length[120]|trim|xss_clean"
			),
			array(
				"field" => "senha",
				"label" => "Senha",
				"rules" => "required|trim|min_length[3]|max_length[50]|xss_clean"
			)
		),
		"geraSlug" => array(
			array(
				"field" => "v",
				"label" => "Slug",
				"rules" => "required|trim|max_length[255]|xss_clean"
			)
		),
		"insere_post" => array(
			array(
				"field" => "post_titulo",
				"label" => "Titulo",
				"rules" => "required|xss_clean|min_length[3]|max_length[255]"
			),
			array(
				"field" => "slug",
				"label" => "Seo Slug.",
				"rules" => "required|trim|xss_clean|min_length[3]|max_length[255]|is_unique[posts.descricao_slug]"
			),
			array(
				"field" => "breve_descricao",
				"label" => "Breve descricao",
				"rules" => "required|xss_clean|min_length[3]|max_length[255]"
			),
			array(
				"field" => "data_hora",
				"label" => "Data",
				"rules" => "required|trim|xss_clean|min_length[10]|max_length[10]|callback_cb_valida_data"
			),
			array(
				"field" => "descricao",
				"label" => "Descricao",
				"rules" => "required|min_length[3]|max_length[4000]"
			),
			array(
				"field" => "ativo",
				"label" => "Ativo",
				"rules" => "required|trim|min_length[1]|max_length[1]|callback_cb_valida_ativo"

			)
		),
	"update_post" => array(
			array(
				"field" => "post_titulo",
				"label" => "Titulo",
				"rules" => "required|xss_clean|min_length[3]|max_length[255]"
			),
			array(
				"field" => "slug",
				"label" => "Seo Slug.",
				"rules" => "required|trim|xss_clean|min_length[3]|max_length[255]"
			),
			array(
				"field" => "breve_descricao",
				"label" => "Breve descricao",
				"rules" => "required|xss_clean|min_length[3]|max_length[255]"
			),
			array(
				"field" => "data_hora",
				"label" => "Data",
				"rules" => "required|trim|xss_clean|min_length[10]|max_length[10]|callback_cb_valida_data"
			),
			array(
				"field" => "descricao",
				"label" => "Descricao",
				"rules" => "required|min_length[3]|max_length[4000]"
			),
			array(
				"field" => "ativo",
				"label" => "Ativo",
				"rules" => "required|trim|min_length[1]|max_length[1]|callback_cb_valida_ativo"

			),
			array(
				"field" => "id",
				"label" => "ID",
				"rules" => "required|trim|min_length[1]|max_length[11]|is_natural_no_zero"
			)
		)
);