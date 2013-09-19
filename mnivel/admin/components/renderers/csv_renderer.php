<?php

require_once 'renderer.php';
require_once 'components/utils/file_utils.php';

class CsvRenderer extends Renderer
{
    function RenderPageNavigator($PageNavigator)
    { }

    function RenderDetailPageEdit($DetailPage)
    {
        $this->RenderPage($DetailPage);
    }
        
    function RenderPage($Page)
    {
        if ($Page->GetContentEncoding() != null)
            header('Content-type: application/csv; charset=' . $Page->GetContentEncoding());
        else
            header("Content-type: application/csv");
    	$this->DisableCacheControl();
        header("Content-Disposition: attachment;Filename=" .
            Path::ReplaceFileNameIllegalCharacters($Page->GetCaption() . ".csv"));
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Pragma: public");
        
        $Grid = $this->Render($Page->GetGrid());
        $this->DisplayTemplate('export/csv_page.tpl',
            array('Page' => $Page),
            array('Grid' => $Grid));
    }
    
    function RenderCustomViewColumn($column)
    {
        $this->result = $column->GetValue();
    }
        
    function RenderGrid(Grid $Grid)
    {
        $Rows = array();
        $HeaderCaptions = array();
        $Grid->GetDataset()->Open();
        foreach($Grid->GetExportColumns() as $Column)
            $HeaderCaptions[] = $Column->GetCaption();
        while($Grid->GetDataset()->Next())
        {
            $Row = array();
            foreach($Grid->GetExportColumns() as $Column)
                $Row[] = htmlspecialchars($this->Render($Column));
            $Rows[] = $Row;
        }
            	
        $this->DisplayTemplate('export/csv_grid.tpl',
            array(
                'Grid' => $Grid
                ),
            array(
                'HeaderCaptions' => $HeaderCaptions,
                'Rows' => $Rows
            ));
    }

    protected function HttpHandlersAvailable() 
    { 
        return false; 
    }
    
    protected function HtmlMarkupAvailable() 
    { 
        return false; 
    }
}
?>