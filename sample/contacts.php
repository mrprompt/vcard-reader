<?php
/**
 * Exemplo de uso da classe Vcard
 * 
 * @author Thiago Paes <mrprompt@gmail.com>
 */
require_once __DIR__ . DIRECTORY_SEPARATOR 
            . '..' . DIRECTORY_SEPARATOR 
            . 'src' . DIRECTORY_SEPARATOR 
            . 'Vcard' . DIRECTORY_SEPARATOR 
            . 'Reader.php';

use VCard\Reader as Vcard;

$vcard    = new Vcard('contacts.vcf');
$contatos = $vcard->toArray();

foreach ($contatos as $contato) {
    $nome = $contato[Vcard::NOME_COMPLETO];
    $telefone = $contato[Vcard::TELEFONE];

    echo "Nome: {$nome} - Telefone: {$telefone}", PHP_EOL;
}