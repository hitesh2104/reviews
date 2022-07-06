<?php
require_once "fpdf.php";
class Pdf_Table extends FPDF {
    public function __construct( $data) {
        $this->data = $data;
        $this->setColumnsTitles($data);        
        parent::__construct();
        $this->SetFont('Arial','B',10);        
        $this->calcColumnsWidth();        
    }
    private $showPageNumber = true;
    private $textPageNumber = "Página %s";
    private $tableTitle = "";
    private $columns = array();
    private $columnsTitles = array();
    private $columnsVisibles = array();
    private $columnsWidth = array();
    private $data = array();
    private $tableX = 0;
    private $headerColor = null;
    private $cellSpacing = 2;
    private $groupColumn = null;
    private $groupsTitles = array();
    public function setShowPageNumber($value) {
        $this->showPageNumber = $value;
    }
    public function getShowPageNumber() {
        return $this->showPageNumber;
    }
    public function setTextPageNumber($value) {
        $this->textPageNumber = $value;
    }
    public function getTextPageNumber() {
        return $this->textPageNumber;
    }
    public function setTableTitle($value) {
        $this->tableTitle = $value;
    }
    public function getTableTitle() {
        return $this->tableTitle;
    }
    public function setHeaderColor($value) {
        $this->headerColor = $value;
    }
    public function getHeaderColor() {
        return $this->headerColor;
    }
    private function hex2rgb($hex) {
       $hex = str_replace("#", "", $hex);
       if(strlen($hex) == 3) {
          $r = hexdec(substr($hex,0,1).substr($hex,0,1));
          $g = hexdec(substr($hex,1,1).substr($hex,1,1));
          $b = hexdec(substr($hex,2,1).substr($hex,2,1));
       } else {
          $r = hexdec(substr($hex,0,2));
          $g = hexdec(substr($hex,2,2));
          $b = hexdec(substr($hex,4,2));
       }
       $rgb = array($r, $g, $b);       
       return $rgb;
    }
    public function setCellSpacing($value) {
        $this->cellSpacing = $value;
    }
    public function getCellSpacing() {
        return $this->cellSpacing;
    }
    public function groupByColumn($column) {
        if (!isset($this->columnsTitles[$column])) {
            throw new Exception("There is no column named {$column}");            
        }
        $this->groupColumn = $column;
    }
    public function setGroupTitle($groupValue, $title) {
        $this->groupsTitles[$groupValue] = $title;
    }
    public function getGroupTitle($groupValue) {
        if (isset($this->groupsTitles[$groupValue])) {
            return $this->groupsTitles[$groupValue];
        }
        return $groupValue;
    }
    public function setColumnVisible($column,$visible) {
        if (!isset($this->columnsVisibles[$column])) {
            throw new Exception("There is no column named {$column}");            
        }
        $this->columnsVisibles[$column] = $visible;
    }
    public function getColumnVisible($column) {
        if (!isset($this->columnsVisibles[$column])) {
            throw new Exception("There is no column named {$column}");                        
        } 
        return $this->columnsVisibles[$column];        
    }    
    public function setColumnTitle($column,$title) {
        if (!isset($this->columnsTitles[$column])) {
            throw new Exception("There is no column named {$column}");            
        }
        $this->columnsTitles[$column] = $this->toIso88592($title);
    }
    public function getColumnTitle($column) {
        if (!isset($this->columnsTitles[$column])) {
            throw new Exception("There is no column named {$column}");                        
        } 
        return $this->columnsTitles[$column];        
    }
    public function setColumnWidth($column,$width) {
        if (!isset($this->columnsWidth[$column])) {
            throw new Exception("There is no column named {$column}");            
        }
        $this->columnsWidth[$column] = $width;
    }
    public function getColumnWidth($column) {
        if (!isset($this->columnsWidth[$column])) {
            throw new Exception("There is no column named {$column}");                        
        } 
        return $this->columnsWidth[$column];        
    }    
    private function setColumnsTitles($data) {
        if (isset($data[0])) {
            $keys = array_keys($data[0]);            
            foreach ($keys as $key) {
                $this->columnsTitles[$key] = $key;
                $this->columnsVisibles[$key] = true;
            }
        }        
    }
    private function groupDataByColumn($column) {
        $values = array();
        foreach ($this->data as $row) {
            $values[] = $row[$column];
        }
        $data = array();
        $values = array_unique($values);
        foreach ($values as $value) {
            foreach ($this->data as $row) {
                if ($row[$column] == $value) {
                    $data[$value][] = $row;
                }
            }
        }
        return $data;
    }
    public function makeTable($name) {
        $this->calcTableX();
        $this->AddPage();
        if (!is_null($this->groupColumn)) {
            $datas = $this->groupDataByColumn($this->groupColumn);
            foreach ($datas as $value => $data) {
                $this->SetFont('Arial','B', 12);                
                $this->Cell(0, 6, $this->getGroupTitle($value), 0, 1, 'C');
                $this->Ln();
                $this->makeTableHeader();
                $this->makeRows($data);    
            }
        } else {
            $this->makeTableHeader();
            $this->makeRows($this->data);    
        }
        
        ob_clean();
        $this->Output($name,"I");
    }
    private function makeTableHeader() {
        $this->SetX($this->tableX);
        $fill = !is_null($this->headerColor);
        if ($fill){            
            $rgb = $this->hex2rgb($this->headerColor);            
            $this->SetFillColor($rgb[0],$rgb[1],$rgb[2]);
        }          
        foreach ($this->columnsTitles as $columnName => $columnTitle) {
            if ($this->getColumnVisible($columnName)) {
                $columnWidth = $this->columnsWidth[$columnName];
                $columnHeight = 6;
                $border = 1;
                $ln = 0;
                $align = 'C';//center
                $this->Cell($columnWidth, $columnHeight, $columnTitle, $border, $ln, $align, $fill);
            }
        }       
        $this->Ln();
    }
    private function makeRows($data) { 
        $this->SetFont('Arial','',10);        
        foreach ($data as $row) {
            $this->SetX($this->tableX);
            foreach ($this->columnsTitles as $columnName => $columnTitle) {
                if ($this->getColumnVisible($columnName)) {
                    $columnValue = $row[$columnName];
                    $columnWidth = $this->columnsWidth[$columnName];
                    $columnHeight = 5;
                    $border = 1;
                    $this->Cell($columnWidth, $columnHeight, $columnValue,$border);                
                }
            }
            $this->Ln();
        }       
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();        
    }
    private function calcColumnsWidth() {
                        
        foreach ($this->columnsTitles as $columnName => $columnTitle) {
            $width = array();
            $width[] = $this->GetStringWidth($columnTitle);
            foreach ($this->data as $row) {
                $width[] = $this->GetStringWidth($row[$columnName]);
            }
            $this->columnsWidth[$columnName] = ceil(max($width))+($this->cellSpacing*2);
        }
    }    
    private function calcTableX() {
        $tableWidth = array_sum($this->columnsWidth);
        $this->tableX = max(($this->w-$tableWidth)/2,0);
    }
    private function toIso88592($text) {
        return iconv('UTF-8', 'ISO-8859-2', $text );
    }
    public function Footer() {
        if ($this->showPageNumber) {
            $this->SetY(-10);    
            $this->SetFont('Arial','B',10);    
            $str = sprintf($this->textPageNumber,$this->PageNo());
            $str = $this->toIso88592($str);
            $this->Cell(0,12,$str,0,0,'C');
        }        
    }
    public function Header() {
        if ($this->tableTitle!='') {
            $this->SetFont('Arial','B',16);
            $this->Cell(0,6,$this->tableTitle,0,1,'C');
            $this->Ln(10);
        }
    }   
}
?>