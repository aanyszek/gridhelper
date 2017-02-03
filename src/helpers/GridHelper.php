<?php

namespace App\Helpers;


use Illuminate\Support\Facades\Config;
use Nayjest\Grids\Components\Base\RenderableRegistry;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\Filters\DateRangePicker;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\RenderFunc;
use Nayjest\Grids\Components\ShowingRecords;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\Components\TotalsRow;
use Nayjest\Grids\DbalDataProvider;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\SelectFilterConfig;

use Nayjest\Grids\ObjectDataRow;

class GridHelper
{
    public static function FieldConfig($name, $label)
    {
        return (new FieldConfig())
        ->setName($name)
        ->setLabel($label)
            ->setSortable(true);
        // ->addFilter(
        //     (new \SelectFilterConfig)
        //         ->setOptions(['1'=>2,'3'=>'4'])
        // );
    }

    public static function FieldConfigFilterLike($name, $label, $filter_field)
    {
        return self::FieldConfig($name, $label)
        ->addFilter(
            (new FilterConfig())
                ->setName($filter_field)
                ->setOperator(FilterConfig::OPERATOR_LIKE)
        );
    }

    public static function FieldConfigFilterOption($name, $label, $options = [])
    {
        return self::FieldConfig($name, $label)
        ->addFilter(
            (new SelectFilterConfig())
                ->setOptions($options)
        );
    }

    public static function ActionButtons($view=true,$edit=true,$delete=true,$edit2=false)
    {
      return   (new FieldConfig)
                        ->setName('id')
                        ->setLabel('Action')
                        ->setCallback(function ($val, ObjectDataRow $row) use ($view,$edit,$edit2,$delete){
                          $data = $row->getSrc();
                          return view('admin.layouts.partial.actionbuttons', compact('val','data','view','edit','edit2','delete'));
                        });
    }

    public static function Components()
    {
      return [
          # Renders table header (table>thead)
          (new THead)
              # Setup inherited components
              ->setComponents([
                      (new ColumnHeadersRow),
                  # Add this if you have filters for automatic placing to this row
                  new FiltersRow,
                  # Row with additional controls
                  (new OneCellRow)
                      ->setComponents([
                          # Control for specifying quantity of records displayed on page
                          (new RecordsPerPage)
                              ->setVariants([
                                  50,
                                  100,
                                  1000
                              ])
                          ,
                          # Control to show/hide rows in table
                         (new ColumnsHider),


                          # Submit button for filters.
                          # Place it anywhere in the grid (grid is rendered inside form by default).
                          (new HtmlTag)
                              ->setTagName('button')
                              ->setAttributes([
                                  'type' => 'submit',
                                  # Some bootstrap classes
                                  'class' => 'btn btn-primary'
                              ])
                              ->setContent('Filter')
                      ])
                      # Components may have some placeholders for rendering children there.
                      ->setRenderSection(THead::SECTION_BEGIN)
              ])
          ,
          # Renders table footer (table>tfoot)
          (new TFoot)
              // ->addComponent(
              //     # TotalsRow component calculates totals on current page
              //     # (max, min, sum, average value, etc)
              //     # and renders results as table row.
              //     # By default there is a sum.
              //     new TotalsRow([
              //         'comments',
              //         'posts',
              //     ])
              // )
              ->addComponent(
                  # Renders row containing one cell
                  # with colspan attribute equal to the table columns count
                  (new OneCellRow)
                      # Pagination control
                      ->addComponent(new Pager)
              )
      ];
    }
}
