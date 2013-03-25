<?php
/**
 * Vcard
 *
 * Lê arquivos vCard
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 */
namespace Vcard;

class Reader
{
    const NOME_COMPLETO = 'FN';
    const EMAIL         = 'EMAIL;TYPE=INTERNET';
    const TELEFONE      = 'item1.TEL';
    const ANIVERSARIO   = 'BDAY';
    const EMPRESA       = 'ORG';
    const TITULO        = 'TITLE';
    const SITE          = 'item1.URL';
    
    /**
     * Conteúdo do VCF
     *
     * @var \SplFileObject 
     */
    protected $_file;
    
    /**
     * Construtor
     * 
     * @param string $file Arquivo VCard a ser parseado
     */
    public function __construct($file)
    {
        $this->_file = new \SplFileObject($file);
        $this->_file->setFlags(\SplFileObject::SKIP_EMPTY);
    }
    
    /**
     * Retorna um array com todos os campos do arquivo vcard.
     * 
     * @return array
     */
    public function toArray()
    {
        /** @var integer $indice Índice do array para o contador de contatos */
        $indice   = 0;
        
        /** @var array $contatos Contatos recuperados */
        $contatos = array();
        
        /** @var array $campos Campos do arquivo */
        $campos   = array();
        
        foreach ($this->_file as $row) {
            preg_match('/(.+):(.+)?/i', $row, $campos);
            
            if (empty($campos[1]) && empty($campos[2])) {
                continue;
            }
            
            $chave = $campos[1];
            $valor = $campos[2];
            
            $contatos[$indice][$chave] = filter_var($valor, FILTER_SANITIZE_STRING);
            
            if ($chave == 'END') {
                $indice++;
            }
        }
        
        return $contatos;
    }
}