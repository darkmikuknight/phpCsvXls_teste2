<?php

class Produtor
{
    // public int $Id;
    public ?string $MatriculaLaticinio;
    public ?string $MatriculaCentroPesquisaCEPA;
    public ?string $MatriculaCentroPesquisaGOIAS;
    public ?string $MatriculaCDL;
    public ?string $MatriculaLaboratorioParana;
    public ?string $MatriculaLaboratorioLABUFMG;
    public ?string $MatriculaLaboratorioEmbrapa;
    public ?string $NomeRazaoSocial;
    public ?string $CpfCnpj;
    public ?string $Email;
    public ?string $RgIe;
    public ?string $DtNascimento;
    public ?string $Endereco;
    public ?int $EnderecoNumero;
    public ?string $Complemento;
    public ?string $Bairro;
    public ?string $UF;
    public ?string $Cidade;
    public ?string $CEP;
    public ?string $Celular1;
    public ?string $Celular2;
    public ?string $Telefone1;
    public ?string $Telefone2;
    public ?string $FazendaSitio;
    public ?string $LatitudeProdutor;
    public ?string $LongitudeProdutor;
    public ?string $Linha;
    public ?string $TitularDoTanque;
}

class ProdutorErros 
{
    public ?string $Field;
    public ?string $ErrorMessage;
}
