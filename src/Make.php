<?php 

namespace NFePHP\GnreRJ;
    
/**
 * Class responsible create DoomDocument
 * NFePHP\GnreRJ\
 * @category  NFePHP
 * @package   NFePHP\GnreRJ\Make
 * @copyright NFePHP Copyright (c) 2008-2018
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Marlon O. Barbosa <marlon.academi at gmail dot com>
 * @link      https://github.com/Focus599Dev/sped-gnre-rj for the canonical source repository
*/

use DOMElement;

class Make{

    /**
     * @var string
    */
    public $xml;

    protected $dados;

    /**
     * @var \NFePHP\Common\DOMImproved
     */
    public $dom;

    public $structure;

    public function __construct(){

        $this->dom = new Dom('1.0', 'UTF-8');
        
        $this->dom->preserveWhiteSpace = false;
        
        $this->dom->formatOutput = false;

    }

     /**
     * Returns xml string and assembly it is necessary
     * @return string
     */
    public function getXML(){
        
        if (empty($this->xml)) {
            
            return null;

        }

        return $this->xml;
    }

    /**
     * GNRe xml mount method
     * this function returns TRUE on success or FALSE on error
     * The xml of the NFe must be retrieved by the getXML() function or
     * directly by the public property $xml
     * @return boolean
     */
    public function monta($structure){

        $this->structure = $structure;

        $identificador = 'CNPJEmitente: CNPJ da empresa';

        $this->dados = $this->dom->createElement("enviarDados");

        $emitente = $this->dom->createElement("emitente");

        $this->dom->addChild(
            $emitente,
            "CNPJEmitente",
            $this->structure->CNPJEmitente,
            true,
            $identificador
        );

        $identificador = 'Email: Email de contato do fisco';

        $this->dom->addChild(
            $emitente,
            "Email",
            $this->structure->Email,
            false,
            $identificador
        );

        $this->dom->appChild($emitente, $this->dados, 'Falta tag "emitente"');

        $documentos = $this->dom->createElement("documentos");
        
        $documento = $this->dom->createElement("Documento");

        $identificador = 'TipoId: Tipo de documento a ser passado';

        $this->dom->addChild(
            $documento,
            "TipoId",
            $this->structure->TipoId,
            true,
            $identificador
        );

        $this->dom->addChild(
            $documento,
            "TipoId",
            $this->structure->TipoId,
            true,
            $identificador
        );

        if ($this->structure->Cnpj){
            
            $identificador = 'Cnpj: CNPJ empresa';

            $this->dom->addChild(
                $documento,
                "Cnpj",
                $this->structure->Cnpj,
                true,
                $identificador
            );   
        } 

        if ($this->structure->Cpf){
            
            $identificador = 'Cpf: Cpf contribuente';

            $this->dom->addChild(
                $documento,
                "Cpf",
                $this->structure->Cpf,
                true,
                $identificador
            );   
        }

        if ($this->structure->Passaporte){
            
            $identificador = 'Passaporte: Passaporte contribuente';

            $this->dom->addChild(
                $documento,
                "Passaporte",
                $this->structure->Passaporte,
                true,
                $identificador
            );   
        }

        $identificador = 'CodigoProduto';

        $this->dom->addChild(
            $documento,
            "CodigoProduto",
            $this->structure->CodigoProduto,
            (intval($this->structure->Natureza) == 4 ||  intval($this->structure->Natureza) == 2),
            $identificador
        ); 

        $identificador = 'DataFatoGerador';

        $this->dom->addChild(
            $documento,
            "DataFatoGerador",
            $this->structure->DataFatoGerador,
            ( intval($this->structure->Natureza == 7) ),
            $identificador
        ); 

        $identificador = 'DataVencimento';

        $this->dom->addChild(
            $documento,
            "DataVencimento",
            $this->structure->DataVencimento,
            true,
            $identificador
        ); 

        $identificador = 'DddContribuinte';

        $this->dom->addChild(
            $documento,
            "DddContribuinte",
            $this->structure->DddContribuinte,
            false,
            $identificador
        );

        $identificador = 'EnderecoContribuinte';

        $this->dom->addChild(
            $documento,
            "EnderecoContribuinte",
            $this->structure->EnderecoContribuinte,
            true,
            $identificador
        );


        $identificador = 'InformacoesComplementares';

        $this->dom->addChild(
            $documento,
            "InformacoesComplementares",
            $this->structure->InformacoesComplementares,
            false,
            $identificador
        );  

        $identificador = 'InscEstadualRJ';

        $this->dom->addChild(
            $documento,
            "InscEstadualRJ",
            $this->structure->InscEstadualRJ,
            false,
            $identificador
        );

        $identificador = 'MunicipioContribuinte';

        $this->dom->addChild(
            $documento,
            "MunicipioContribuinte",
            $this->structure->MunicipioContribuinte,
            true,
            $identificador
        );

        $identificador = 'UFContribuinte';

        $this->dom->addChild(
            $documento,
            "UFContribuinte",
            $this->structure->UFContribuinte,
            false,
            $identificador
        );

        $identificador = 'CepContribuinte';

        $this->dom->addChild(
            $documento,
            "CepContribuinte",
            $this->structure->CepContribuinte,
            false,
            $identificador
        );

        $identificador = 'TelefoneContribuinte';

        $this->dom->addChild(
            $documento,
            "TelefoneContribuinte",
            $this->structure->TelefoneContribuinte,
            false,
            $identificador
        );

        $identificador = 'Natureza';

        $this->dom->addChild(
            $documento,
            "Natureza",
            $this->structure->Natureza,
            true,
            $identificador
        );

        $identificador = 'NaturezaQualificacao';

        $this->dom->addChild(
            $documento,
            "NaturezaQualificacao",
            $this->structure->NaturezaQualificacao,
            ( intval($this->structure->Natureza == 1) ),
            $identificador
        );

        $identificador = 'NomeRazaoSocial';

        $this->dom->addChild(
            $documento,
            "NomeRazaoSocial",
            $this->structure->NomeRazaoSocial,
            true,
            $identificador
        );

        $identificador = 'NomeRazaoSocial';

        $this->dom->addChild(
            $documento,
            "NomeRazaoSocial",
            $this->structure->NomeRazaoSocial,
            true,
            $identificador
        );

        $identificador = 'NomeRazaoSocial';

        $this->dom->addChild(
            $documento,
            "NomeRazaoSocial",
            $this->structure->NomeRazaoSocial,
            true,
            $identificador
        );

        $identificador = 'NotaFiscalCnpj';

        $this->dom->addChild(
            $documento,
            "NotaFiscalCnpj",
            $this->structure->NotaFiscalCnpj,
            false,
            $identificador
        );

        $identificador = 'NotaFiscalCpf';

        $this->dom->addChild(
            $documento,
            "NotaFiscalCpf",
            $this->structure->NotaFiscalCpf,
            false,
            $identificador
        );

        $identificador = 'NotaFiscalDataEmissao';

        $this->dom->addChild(
            $documento,
            "NotaFiscalDataEmissao",
            $this->structure->NotaFiscalDataEmissao,
            false,
            $identificador
        );

        $identificador = 'NotaFiscalNumero';

        $this->dom->addChild(
            $documento,
            "NotaFiscalNumero",
            $this->structure->NotaFiscalNumero,
            false,
            $identificador
        );

        $identificador = 'NotaFiscalSerie';

        $this->dom->addChild(
            $documento,
            "NotaFiscalSerie",
            $this->structure->NotaFiscalSerie,
            false,
            $identificador
        );

        $identificador = 'NotaFiscalTipo';

        $this->dom->addChild(
            $documento,
            "NotaFiscalTipo",
            $this->structure->NotaFiscalTipo,
            false,
            $identificador
        );

        $identificador = 'TipoImportacao';

        $this->dom->addChild(
            $documento,
            "TipoImportacao",
            $this->structure->TipoImportacao,
            ( intval($this->structure->Natureza == 5) ),
            $identificador
        );

        $identificador = 'NumDocOrigem';

        $this->dom->addChild(
            $documento,
            "NumDocOrigem",
            $this->structure->NumDocOrigem,
            ( intval($this->structure->Natureza == 5) ),
            $identificador
        );

        $identificador = 'NumControleContribuinte';

        $this->dom->addChild(
            $documento,
            "NumControleContribuinte",
            $this->structure->NumControleContribuinte,
            true,
            $identificador
        );

        $identificador = 'TipoApuracao';

        $this->dom->addChild(
            $documento,
            "TipoApuracao",
            $this->structure->TipoApuracao,
            false,
            $identificador
        );

        $identificador = 'TipoPeriodoApuracao';

        $this->dom->addChild(
            $documento,
            "TipoPeriodoApuracao",
            $this->structure->TipoPeriodoApuracao,
            false,
            $identificador
        );

        $identificador = 'PeriodoReferenciaAno';

        $this->dom->addChild(
            $documento,
            "PeriodoReferenciaAno",
            $this->structure->PeriodoReferenciaAno,
            false,
            $identificador
        );

        $identificador = 'PeriodoReferenciaMes';

        $this->dom->addChild(
            $documento,
            "PeriodoReferenciaMes",
            $this->structure->PeriodoReferenciaMes,
            false,
            $identificador
        );

        $identificador = 'PeriodoReferenciaDecendio';

        $this->dom->addChild(
            $documento,
            "PeriodoReferenciaDecendio",
            $this->structure->PeriodoReferenciaDecendio,
            false,
            $identificador
        );

        $identificador = 'DiaVencimento';

        $this->dom->addChild(
            $documento,
            "DiaVencimento",
            $this->structure->DiaVencimento,
            false,
            $identificador
        );

        $identificador = 'ValorICMSPrincipal';

        $this->dom->addChild(
            $documento,
            "ValorICMSPrincipal",
            $this->structure->ValorICMSPrincipal,
            false,
            $identificador
        );

        $identificador = 'ValorFECPPrincipal';

        $this->dom->addChild(
            $documento,
            "ValorFECPPrincipal",
            $this->structure->ValorFECPPrincipal,
            false,
            $identificador
        );

        $identificador = 'ValorTotal';

        $this->dom->addChild(
            $documento,
            "ValorTotal",
            $this->structure->ValorTotal,
            true,
            $identificador
        );

        $this->dom->appChild($documento, $documentos, 'Falta tag "Documento"');

        $this->dom->appChild($documentos, $this->dados, 'Falta tag "documentos"');

        $this->xml = $this->dom->saveXML();
        
        return true;
        
    }

}

?>