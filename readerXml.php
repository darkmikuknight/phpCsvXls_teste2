<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

include('Produtor.php');

$fileName = 'teste.xlsx';
// $fileName = "teste.csv";
$fileExtension = '';
$fileRead = [];

function GetFileExtension (string $name): string
{
    $nameArray = explode(".", $name);

    if ($nameArray[count($nameArray) - 1] == 'xlsx' || $nameArray[count($nameArray) - 1] == 'xls') {
        return 'xlsx';
    } else if ($nameArray[count($nameArray) - 1] == 'csv') {
        return 'csv';
    } else return '';
}

function GetBaseProdutorDB (array $fileRead): object
{
    $result = [];
    $produtorFileHeader = array_shift($fileRead);
    $count = 0;

    foreach ($fileRead as $line) {
        $prod = new \Produtor();

        if (count($line) == count($produtorFileHeader)) {
            array_push($result, $prod);

            $result[$count]->MatriculaLaticinio = $line[0] != null ? $line[0] : null;
            $result[$count]->MatriculaCentroPesquisaCEPA = $line[1] != null ? $line[1] : null;
            $result[$count]->MatriculaCentroPesquisaGOIAS = $line[2] != null ? $line[2] : null;
            $result[$count]->MatriculaCDL = $line[3] != null ? $line[3] : null;
            $result[$count]->MatriculaLaboratorioParana = $line[4] != null ? $line[4] : null;
            $result[$count]->MatriculaLaboratorioLABUFMG = $line[5] != null ? $line[5] : null;
            $result[$count]->MatriculaLaboratorioEmbrapa = $line[6] != null ? $line[6] : null;
            $result[$count]->NomeRazaoSocial = $line[7] != null ? $line[7] : null;
            $result[$count]->CpfCnpj = $line[8] != null ? $line[8] : null;
            $result[$count]->Email = $line[9] != null ? $line[9] : null;
            $result[$count]->RgIe = $line[10] != null ? $line[10] : null;
            $result[$count]->DtNascimento = $line[11] != null ? $line[11] : null;
            $result[$count]->Endereco = $line[12] != null ? $line[12] : null;
            $result[$count]->EnderecoNumero = $line[13] != null ? $line[13] : null;
            $result[$count]->Complemento = $line[14] != null ? $line[14] : null;
            $result[$count]->Bairro = $line[15] != null ? $line[15] : null;
            $result[$count]->UF = $line[16] != null ? $line[16] : null;
            $result[$count]->Cidade = $line[17] != null ? $line[17] : null;
            $result[$count]->CEP = $line[18] != null ? $line[18] : null;
            $result[$count]->Celular1 = $line[19] != null ? $line[19] : null;
            $result[$count]->Celular2 = $line[20] != null ? $line[20] : null;
            $result[$count]->Telefone1 = $line[21] != null ? $line[21] : null;
            $result[$count]->Telefone2 = $line[22] != null ? $line[22] : null;
            $result[$count]->FazendaSitio = $line[23] != null ? $line[23] : null;
            $result[$count]->LatitudeProdutor = $line[24] != null ? $line[24] : null;
            $result[$count]->LongitudeProdutor = $line[25] != null ? $line[25] : null;
            $result[$count]->Linha = $line[26] != null ? $line[26] : null;
            $result[$count]->TitularDoTanque = $line[27] != null ? $line[27] : null;
        }

        $count++;
    }
    return (object) $result;
}

function CreateError(int $lineNumber, string $fieldName, string $message, $erroClass) : object
{
    $erro = $erroClass;
    $erro->Field = $fieldName;
    $erro->ErrorMessage = "Linha {$lineNumber}: {$message}";
    return $erro;
}

function GenerateError (object $fileRead) : void
{
    $erros = []; // array (new ProdutorErros());
    $lineNumber = 1;

    foreach($fileRead as $line) {
        if (empty($line->MatriculaCentroPesquisaCEPA)) {
            $erroClass = new ProdutorErros();
            // $erro->Field = 'Campo Matricula';
            // $erro->ErrorMessage = "Linha {$lineNumber}: Campo não pode ser vazio";
            $teste = CreateError($lineNumber, 'Matricula', 'Campo não pode ser vazio', $erroClass);
            array_push($erros, $teste);
        }

        $lineNumber++;
    }

    $sss = 55;
}

$fileExtension = GetFileExtension($fileName);

if ($fileExtension === 'xlsx') {
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadSheet = $reader->load($fileName);
    $spreadSheet = $spreadSheet->getActiveSheet()->toArray();

    foreach ($spreadSheet as $line) {
        if(count(array_filter($line)) > 0) {
            array_push($fileRead, $line);
        }
    }

    // TODO retornar o &fileRead
    $teste = GetBaseProdutorDB($fileRead);
    GenerateError($teste);
} else if ($fileExtension === 'csv') {
    if (($handle = fopen($fileName, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $line = explode(";", $data[0]);

            if(count($line) > 0 && $line[0] !== '') {
                array_push($fileRead, $line);
            }
        }
        fclose($handle);

        // TODO retornar o &fileRead
    }
}
