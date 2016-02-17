<?php
/*------------------------------------------------------------------------------------------------
|  Classe: criada para dar upload em quantas fotos de uma vez quiser                             |
|    Data: 05/01/2009                                                                            |
| Métodos: (+)recebe_upload();                                                                   |
|		   (-)dimensoesThumbPOPUP();                                                             |
|		   (-)fazThumb();                                                                        |
|Objetivo: fazer o upload de fotos e gerar duas thumbs                                           |
| Entrada: parâmetro de entrada $_FILES['foto'] onde o mesmo é um vetor, no html ele fica assim: |
|          <input type="file" name="foto[]" />                                                   |
|   Saída: parâmetros de retorno é uma matriz com o nome das fotos criadas dinâmicamente,        |
|          $vet_fotos, para resgatar os nomes basta dar um count($vet_fotos) ou usar o foreach   |
--------------------------------------------------------------------------------------------------*/

class Upload
{
	public $FILES;
	public $CI;
	
	// aqui como argumento éh inserido $_FILES['foto']		
	//$FILES É UM ARGUMENTO QUE TEM COMO ENTRADA $_FILE['foto'] que está sendo uploadado

	public function __construct(){}

	public function recebe_upload($f=NULL, $CI=NULL) // aqui como argumento éh inserido $_FILES['foto']
	{
		//$FILES É UM ARGUMENTO QUE TEM COMO ENTRADA $_FILE['foto'] que está sendo uploadado
		
		if($f == NULL || $f == "" || $CI == NULL):
			return false;
			exit;
		endif;

		$this->CI = $CI;

		$this->FILES = $f;

		//colocando tudo em caixa baixa
		$arquivoNome = $this->FILES['name'][0];
		
		//pegando a extensao do arquivo
		$extensao = strtolower(pathinfo($arquivoNome, PATHINFO_EXTENSION));
		
		//jogando o arquivoNome para caixa baixa
		$arquivoNome = strtolower($arquivoNome);
		
		//pegando somente o nome da foto
		$somenteNomeSemExtensao = str_replace(".".$extensao, "", $arquivoNome);
		
		
		//pegando as extensões permitidas
		if($extensao == "gif" || $extensao == "png" || $extensao == "jpg" || $extensao == "jpeg" || $extensao == "pjpeg"):
		
			$nomeFotoParaBanco = $somenteNomeSemExtensao . "-" . uniqid() . "." . $extensao;
			

									
			/*----------------------------------------------------------------
			$foto = array(
				"codproduto" => $codproduto,
				"produtofotoextensao" => $extensao
			);
			$codfoto = $this->produtofoto_m->post($foto);
			===================================================================*/
			
			//FCPATH É A PASTA RAIZ DO SISTEMA
			$enderecoFoto = "/assets/fotos-post/upload/".$nomeFotoParaBanco;
			move_uploaded_file($this->FILES['tmp_name'][0], FCPATH . $enderecoFoto);
			
			
			//MINIATURA PARA PÁGINA DE DETALHES
			//NOME DA FOTO, ALTURA E LARGURA - FALSE PARA NÃO MANTER RATIO
			//$this->redimensionaFoto($nomeFotoParaBanco, 120,  120, FALSE);
			
			//CRIA A FOTO PARA PAGINA DE DETALHES - TRUE MANTEM O RATIO
			$this->redimensionaFoto($nomeFotoParaBanco, 240, 240, TRUE);
			
			//MINIATURA PARA IR NO FRONT DO SITE
			//NOME DA FOTO, ALTURA E LARGURA - FALSE PARA NAO MANTER RATIO
			//AQUI VAI O CROP DA FOTO 500X500
			/*---------------------------------------------------------------------
			 * 
			 * OBS.: AS IMAGENS 380 POR 235 SERÃO COLOCADAS DEPOIS
			 * 
			 * --------------------------------------------------------------------*/
			//$this->cropFoto($nomeFotoParaBanco, 380,  235, $extensao);
			
			//COLOCANDO A MARCA DAGUA NA FOTO 500X500
			//A WATERMARK SERÁ COLOCADA NO RECORTE DAS FOTOS PARA CAPA
			//$this->watermark($nomeFotoParaBanco);
			
			//DELETANDO A FOTO PRINCIPAL
			//FCPATH É O CAMINHO PARA O ROOT
			if(file_exists(FCPATH . "/assets/fotos-post/upload/$nomeFotoParaBanco")):
				unlink(FCPATH . "/assets/fotos-post/upload/$nomeFotoParaBanco");
			endif;

			return $nomeFotoParaBanco;
		endif;
	}

	//REDIMENSIONA AS IMAGENS
	private function redimensionaFoto($nomeFoto, $altura, $largura, $ratio){
		
		/*
		if(!is_dir(FCPATH . "/assets/img/imovel/{$altura}x{$largura}/")){
			mkdir(FCPATH . "/assets/img/imovel/{$altura}x{$largura}/");
		}
		*/
		
		$configImagem['image_library'] = 'gd2'; //Biblioteca responsavel pelo redimensionamento
		$configImagem['source_image'] = FCPATH . "/assets/fotos-post/upload/".$nomeFoto;
		$configImagem['new_image'] = FCPATH . "/assets/fotos-post/fotos/".$nomeFoto;
		$configImagem['create_thumb'] = FALSE;
		$configImagem['maintain_ratio'] = $ratio;
		$configImagem['width'] = $largura;
		$configImagem['height'] = $altura;
		
		$this->CI->load->library('image_lib');
		$this->CI->image_lib->clear();
		$this->CI->image_lib->initialize($configImagem);
		
		$this->CI->image_lib->resize();
	}
	
	protected function permitidos($ext){
		$permitidos = array('jpg','jpeg','pjpeg','png','gif');
		if(in_array($ext,$permitidos)){
			$retorno = true;
		}else{
			$retorno = false;
		}
		return $retorno;
	}

	protected function tamanhoMaximo($filesize){
		if($filesize <= 2000000){
			$retorno = true;
		}else{
			$retorno = false;
		}
		return $retorno;
	}
}

?>