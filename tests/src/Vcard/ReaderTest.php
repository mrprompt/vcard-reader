<?php
namespace Vcard;

require_once __DIR__ . DIRECTORY_SEPARATOR 
            . '..' . DIRECTORY_SEPARATOR 
            . '..' . DIRECTORY_SEPARATOR 
            . '..' . DIRECTORY_SEPARATOR 
            . 'src' . DIRECTORY_SEPARATOR 
            . 'Vcard' . DIRECTORY_SEPARATOR 
            . 'Reader.php';

$fileTemplate = <<<TEXT
BEGIN:VCARD
VERSION:3.0
FN:Thiago Paes
N:Paes;Thiago;;;
EMAIL;TYPE=INTERNET:mrprompt@facebook.com
ORG:Empresa
TITLE:Programmer
BDAY:1982-03-06
item1.TEL:+554800000000
item1.X-ABLabel:Celular
item1.URL:http\://thiagopaes.com.br
item1.X-ABLabel:_\$!<HomePage>!\$_
END:VCARD
TEXT;
        
class ReaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Cliente
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        global $fileTemplate;
        
        file_put_contents('vcard.tmp', $fileTemplate);
        
        $this->object = new \Vcard\Reader('vcard.tmp');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unlink('vcard.tmp');
    }

    /**
     * @cover \Vcard\Reader::toArray
     */
    public function testToArray()
    {
        $contacts = $this->object->toArray();
        
        $this->assertTrue(is_array($contacts));
    }
}
