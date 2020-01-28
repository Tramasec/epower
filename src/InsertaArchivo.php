<?php
declare(strict_types=1);
namespace EPower;

use GuzzleHttp\Client;

class InsertaArchivo
{

    /**
     * @var string $url
     */
    protected $url = null;

    /**
     * @var int $appId
     */
    protected $appId = null;

    /**
     * @var int $doctype
     */
    protected $doctype = null;

    /**
     * @var int $query
     */
    protected $query = null;

    /**
     * @var ArrayOfstring $IndicesEpower
     */
    protected $IndicesEpower = null;

    /**
     * @var string $cejilla
     */
    protected $cejilla = null;

    /**
     * @var string $Archivo
     */
    protected $Archivo = null;

    /**
     * @var string $OriginalName
     */
    protected $OriginalName = null;

    /**
     * @var string $OriginalExtencion
     */
    protected $OriginalExtencion = null;

    /**
     * @param string $url
     * @param int $appId
     * @param int $doctype
     * @param int $query
     * @param ArrayOfstring $IndicesEpower
     * @param string $cejilla
     * @param string $Archivo
     * @param string $OriginalName
     * @param string $OriginalExtencion
     */
    public function __construct($url, $appId, $doctype, $query, $IndicesEpower, $cejilla, $Archivo, $OriginalName, $OriginalExtencion)
    {
        $this->url = $url;
        $this->appId = $appId;
        $this->doctype = $doctype;
        $this->query = $query;
        $this->IndicesEpower = $IndicesEpower;
        $this->cejilla = $cejilla;
        $this->Archivo = $Archivo;
        $this->OriginalName = $OriginalName;
        $this->OriginalExtencion = $OriginalExtencion;
    }

    /**
     * @return int
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param int $appId
     * @return InsertaArchivo
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;
        return $this;
    }

    /**
     * @return int
     */
    public function getDoctype()
    {
        return $this->doctype;
    }

    /**
     * @param int $doctype
     * @return InsertaArchivo
     */
    public function setDoctype($doctype)
    {
        $this->doctype = $doctype;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param int $query
     * @return InsertaArchivo
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return ArrayOfstring
     */
    public function getIndicesEpower()
    {
        return $this->IndicesEpower;
    }

    /**
     * @param ArrayOfstring $IndicesEpower
     * @return InsertaArchivo
     */
    public function setIndicesEpower($IndicesEpower)
    {
        $this->IndicesEpower = $IndicesEpower;
        return $this;
    }

    /**
     * @return string
     */
    public function getCejilla()
    {
        return $this->cejilla;
    }

    /**
     * @param string $cejilla
     * @return InsertaArchivo
     */
    public function setCejilla($cejilla)
    {
        $this->cejilla = $cejilla;
        return $this;
    }

    /**
     * @return string
     */
    public function getArchivo()
    {
        return $this->Archivo;
    }

    /**
     * @param string $Archivo
     * @return InsertaArchivo
     */
    public function setArchivo($Archivo)
    {
        $this->Archivo = $Archivo;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalName()
    {
        return $this->OriginalName;
    }

    /**
     * @param string $OriginalName
     * @return InsertaArchivo
     */
    public function setOriginalName($OriginalName)
    {
        $this->OriginalName = $OriginalName;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalExtencion()
    {
        return $this->OriginalExtencion;
    }

    /**
     * @param string $OriginalExtencion
     * @return InsertaArchivo
     */
    public function setOriginalExtencion($OriginalExtencion)
    {
        $this->OriginalExtencion = $OriginalExtencion;
        return $this;
    }

    public function render()
    {
        $indices = '';
        foreach ($this->getIndicesEpower() as $index) {
            $indices.= '<arr:string>'.$index.'</arr:string>';
        }

        $template = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/" xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays">
   <soapenv:Header/>
   <soapenv:Body>
      <tem:InsertaArchivo>
         <tem:appId>'.$this->appId.'</tem:appId>
         <tem:doctype>'.$this->doctype.'</tem:doctype>
         <tem:query>'.$this->query.'</tem:query>
         <tem:IndicesEpower>
            '.$indices.'
         </tem:IndicesEpower>
         <tem:cejilla>'.$this->cejilla.'</tem:cejilla>
         <tem:Archivo>'.$this->Archivo.'</tem:Archivo>
         <tem:OriginalName>'.$this->OriginalName.'</tem:OriginalName>
         <tem:OriginalExtencion>'.$this->OriginalExtencion.'</tem:OriginalExtencion>
      </tem:InsertaArchivo>
   </soapenv:Body>
</soapenv:Envelope>';



        return $template;
    }

    public function InsertaArchivo()
    {
        $starttime = microtime(true);

        $client = new Client();

        $options = [
            'body'    => $this->render(),
            'headers' => [
                "Content-Type" => "text/xml",
                'force_ip_resolve' => 'v4',
                'SOAPAction' => 'http://tempuri.org/IService1/InsertaArchivo'
            ]
        ];

        try {
            $res = $client->request('POST', $this->url, $options);
            $res = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $res->getBody()->getContents());
            $response = simplexml_load_string($res);


            $endtime = microtime(true);
            $timediff = $endtime - $starttime;

            return new InsertaArchivoResponse(
                (boolean) $response->sBody->InsertaArchivoResponse->InsertaArchivoResult,
                $timediff
            );
        } catch (\Throwable $e) {
            $endtime = microtime(true);
            $timediff = $endtime - $starttime;

            return new InsertaArchivoResponse(
                false,
                $timediff,
                $e->getMessage()
            );
        }
    }
}
