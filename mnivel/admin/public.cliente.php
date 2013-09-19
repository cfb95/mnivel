<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in browser (Internet Explorer, Mozilla firefox, etc.)
 * this means that
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */


    require_once 'components/utils/check_utils.php';
    CheckPHPVersion();



    require_once 'database_engine/pgsql_engine.php';
    require_once 'components/page.php';
    require_once 'phpgen_settings.php';
    require_once 'authorization.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthorizationStrategy()->ApplyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    ?><?php
    
    ?><?php
    
    class public_movDetailView0Page extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."mov"');
            $field = new IntegerField('id');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('tipo_operacion');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('operacion');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('cliente');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('deb');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('cred');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('tipo_operacion', 'public.tipo_operacion', new IntegerField('id'), new StringField('sigla', 'tipo_operacion_sigla', 'tipo_operacion_sigla_public_tipo_operacion'), 'tipo_operacion_sigla_public_tipo_operacion');
            $this->dataset->AddLookupField('operacion', 'public.operacion', new IntegerField('id'), new IntegerField('cliente', 'operacion_cliente', 'operacion_cliente_public_operacion'), 'operacion_cliente_public_operacion');
            $this->dataset->AddLookupField('cliente', 'public.cliente', new IntegerField('id'), new IntegerField('plan', 'cliente_plan', 'cliente_plan_public_cliente'), 'cliente_plan_public_cliente');
        }
    
        protected function AddFieldColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_operacion_sigla', 'Tipo Operacion', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for cliente field
            //
            $column = new TextViewColumn('operacion_cliente', 'Operacion', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for operacion field
            //
            $editor = new ComboBox('operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('cliente');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('comprobante');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('deb');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('cred');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('importe');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('cliente', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Operacion', 
                'operacion', 
                $editor, 
                $this->dataset, 'id', 'cliente', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for operacion field
            //
            $editor = new ComboBox('operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('cliente');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('comprobante');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('deb');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('cred');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('importe');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('cliente', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Operacion', 
                'operacion', 
                $editor, 
                $this->dataset, 'id', 'cliente', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for plan field
            //
            $column = new TextViewColumn('cliente_plan', 'Cliente', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for cliente field
            //
            $editor = new ComboBox('cliente_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('plan');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nro_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('apellidos');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_ing');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $field = new StringField('clave');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_nacim');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $field = new StringField('residencia');
            $lookupDataset->AddField($field, false);
            $field = new StringField('email');
            $lookupDataset->AddField($field, false);
            $field = new StringField('telefono');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_patrocinador');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('plan', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Cliente', 
                'cliente', 
                $editor, 
                $this->dataset, 'id', 'plan', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for cliente field
            //
            $editor = new ComboBox('cliente_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('plan');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nro_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('apellidos');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_ing');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $field = new StringField('clave');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_nacim');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $field = new StringField('residencia');
            $lookupDataset->AddField($field, false);
            $field = new StringField('email');
            $lookupDataset->AddField($field, false);
            $field = new StringField('telefono');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_patrocinador');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('plan', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Cliente', 
                'cliente', 
                $editor, 
                $this->dataset, 'id', 'plan', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for deb field
            //
            $column = new TextViewColumn('deb', 'Deb', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for cred field
            //
            $column = new TextViewColumn('cred', 'Cred', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fecha_ins field
            //
            $column = new DateTimeViewColumn('fecha_ins', 'Fecha Ins', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d', 1);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d', 1);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties($column)
        {
            $column->SetShowSetToNullCheckBox(true);
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'public_movDetailViewGrid0');
            $result->SetAllowDeleteSelected(false);
            $result->SetUseFixedHeader(false);
            
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $this->AddFieldColumns($result);
    
            return $result;
        }
    }
    
    
    
    ?><?php
    
    ?><?php
    
    class public_movDetailEdit0Page extends DetailPageEdit
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."mov"');
            $field = new IntegerField('id');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('tipo_operacion');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('operacion');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('cliente');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('deb');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('cred');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('tipo_operacion', 'public.tipo_operacion', new IntegerField('id'), new StringField('sigla', 'tipo_operacion_sigla', 'tipo_operacion_sigla_public_tipo_operacion'), 'tipo_operacion_sigla_public_tipo_operacion');
            $this->dataset->AddLookupField('operacion', 'public.operacion', new IntegerField('id'), new IntegerField('cliente', 'operacion_cliente', 'operacion_cliente_public_operacion'), 'operacion_cliente_public_operacion');
            $this->dataset->AddLookupField('cliente', 'public.cliente', new IntegerField('id'), new IntegerField('plan', 'cliente_plan', 'cliente_plan_public_cliente'), 'cliente_plan_public_cliente');
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            return null;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl($grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('public_movDetailEdit0ssearch', $this->dataset,
                array('id', 'tipo_operacion_sigla', 'operacion_cliente', 'cliente_plan', 'deb', 'cred', 'fecha_ins'),
                array($this->RenderText('Id'), $this->RenderText('Tipo Operacion'), $this->RenderText('Operacion'), $this->RenderText('Cliente'), $this->RenderText('Deb'), $this->RenderText('Cred'), $this->RenderText('Fecha Ins')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl($grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('public_movDetailEdit0asearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id', $this->RenderText('Id')));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('tipo_operacion', $this->RenderText('Tipo Operacion'), $lookupDataset, 'id', 'sigla', false));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('cliente');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('comprobante');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('deb');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('cred');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('importe');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('operacion', $this->RenderText('Operacion'), $lookupDataset, 'id', 'cliente', false));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('plan');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nro_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('apellidos');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_ing');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $field = new StringField('clave');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_nacim');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $field = new StringField('residencia');
            $lookupDataset->AddField($field, false);
            $field = new StringField('email');
            $lookupDataset->AddField($field, false);
            $field = new StringField('telefono');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_patrocinador');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_pid');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('cliente', $this->RenderText('Cliente'), $lookupDataset, 'id', 'plan', false));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('deb', $this->RenderText('Deb')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('cred', $this->RenderText('Cred')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('fecha_ins', $this->RenderText('Fecha Ins')));
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function AddOperationsColumns($grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = $grid->AddViewColumn(new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset), $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
        }
    
        protected function AddFieldColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_operacion_sigla', 'Tipo Operacion', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for cliente field
            //
            $column = new TextViewColumn('operacion_cliente', 'Operacion', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for operacion field
            //
            $editor = new ComboBox('operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('cliente');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('comprobante');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('deb');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('cred');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('importe');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('cliente', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Operacion', 
                'operacion', 
                $editor, 
                $this->dataset, 'id', 'cliente', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for operacion field
            //
            $editor = new ComboBox('operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('cliente');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('comprobante');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('deb');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('cred');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('importe');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('cliente', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Operacion', 
                'operacion', 
                $editor, 
                $this->dataset, 'id', 'cliente', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for plan field
            //
            $column = new TextViewColumn('cliente_plan', 'Cliente', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for cliente field
            //
            $editor = new ComboBox('cliente_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('plan');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nro_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('apellidos');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_ing');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $field = new StringField('clave');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_nacim');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $field = new StringField('residencia');
            $lookupDataset->AddField($field, false);
            $field = new StringField('email');
            $lookupDataset->AddField($field, false);
            $field = new StringField('telefono');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_patrocinador');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('plan', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Cliente', 
                'cliente', 
                $editor, 
                $this->dataset, 'id', 'plan', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for cliente field
            //
            $editor = new ComboBox('cliente_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('plan');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nro_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('apellidos');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_ing');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $field = new StringField('clave');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_nacim');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $field = new StringField('residencia');
            $lookupDataset->AddField($field, false);
            $field = new StringField('email');
            $lookupDataset->AddField($field, false);
            $field = new StringField('telefono');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_patrocinador');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('plan', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Cliente', 
                'cliente', 
                $editor, 
                $this->dataset, 'id', 'plan', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for deb field
            //
            $column = new TextViewColumn('deb', 'Deb', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for cred field
            //
            $column = new TextViewColumn('cred', 'Cred', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fecha_ins field
            //
            $column = new DateTimeViewColumn('fecha_ins', 'Fecha Ins', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d', 1);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d', 1);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_operacion_sigla', 'Tipo Operacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cliente field
            //
            $column = new TextViewColumn('operacion_cliente', 'Operacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for plan field
            //
            $column = new TextViewColumn('cliente_plan', 'Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for deb field
            //
            $column = new TextViewColumn('deb', 'Deb', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cred field
            //
            $column = new TextViewColumn('cred', 'Cred', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fecha_ins field
            //
            $column = new DateTimeViewColumn('fecha_ins', 'Fecha Ins', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns($grid)
        {
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for operacion field
            //
            $editor = new ComboBox('operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('cliente');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('comprobante');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('deb');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('cred');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('importe');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('cliente', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Operacion', 
                'operacion', 
                $editor, 
                $this->dataset, 'id', 'cliente', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for cliente field
            //
            $editor = new ComboBox('cliente_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('plan');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nro_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('apellidos');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_ing');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $field = new StringField('clave');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_nacim');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $field = new StringField('residencia');
            $lookupDataset->AddField($field, false);
            $field = new StringField('email');
            $lookupDataset->AddField($field, false);
            $field = new StringField('telefono');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_patrocinador');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('plan', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Cliente', 
                'cliente', 
                $editor, 
                $this->dataset, 'id', 'plan', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d', 1);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns($grid)
        {
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for operacion field
            //
            $editor = new ComboBox('operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('cliente');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha');
            $lookupDataset->AddField($field, false);
            $field = new StringField('comprobante');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('deb');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('cred');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('importe');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('cliente', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Operacion', 
                'operacion', 
                $editor, 
                $this->dataset, 'id', 'cliente', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for cliente field
            //
            $editor = new ComboBox('cliente_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new IntegerField('plan');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nro_doc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nombres');
            $lookupDataset->AddField($field, false);
            $field = new StringField('apellidos');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_ing');
            $lookupDataset->AddField($field, false);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $field = new StringField('clave');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad');
            $lookupDataset->AddField($field, false);
            $field = new DateField('fecha_nacim');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $field = new StringField('residencia');
            $lookupDataset->AddField($field, false);
            $field = new StringField('email');
            $lookupDataset->AddField($field, false);
            $field = new StringField('telefono');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_patrocinador');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cod_pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('plan', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Cliente', 
                'cliente', 
                $editor, 
                $this->dataset, 'id', 'plan', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d', 1);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(false);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_operacion_sigla', 'Tipo Operacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for cliente field
            //
            $column = new TextViewColumn('operacion_cliente', 'Operacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for plan field
            //
            $column = new TextViewColumn('cliente_plan', 'Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for deb field
            //
            $column = new TextViewColumn('deb', 'Deb', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for cred field
            //
            $column = new TextViewColumn('cred', 'Cred', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fecha_ins field
            //
            $column = new DateTimeViewColumn('fecha_ins', 'Fecha Ins', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_operacion_sigla', 'Tipo Operacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for cliente field
            //
            $column = new TextViewColumn('operacion_cliente', 'Operacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for plan field
            //
            $column = new TextViewColumn('cliente_plan', 'Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for deb field
            //
            $column = new TextViewColumn('deb', 'Deb', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for cred field
            //
            $column = new TextViewColumn('cred', 'Cred', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for fecha_ins field
            //
            $column = new DateTimeViewColumn('fecha_ins', 'Fecha Ins', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        protected function ApplyCommonColumnEditProperties($column)
        {
            $column->SetShowSetToNullCheckBox(true);
    	$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'public_movDetailEditGrid0');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
                $result->SetAllowDeleteSelected(false);
            else
                $result->SetAllowDeleteSelected(false);
            ApplyCommonPageSettings($this, $result);
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
    
            return $result;
        }
        
        protected function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }    
    }
    
    
    
    ?><?php
    
    ?><?php
    
    class public_operacionDetailView1Page extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."operacion"');
            $field = new IntegerField('id');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('cliente');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('tipo_operacion');
            $this->dataset->AddField($field, false);
            $field = new DateField('fecha');
            $this->dataset->AddField($field, false);
            $field = new StringField('comprobante');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('deb');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('cred');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('importe');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('tipo_operacion', 'public.tipo_operacion', new IntegerField('id'), new StringField('tipo_operacion', 'tipo_operacion_tipo_operacion', 'tipo_operacion_tipo_operacion_public_tipo_operacion'), 'tipo_operacion_tipo_operacion_public_tipo_operacion');
            $this->dataset->AddLookupField('cliente', 'public.v_dd_cliente', new IntegerField('id'), new StringField('descr', 'cliente_descr', 'cliente_descr_public_v_dd_cliente'), 'cliente_descr_public_v_dd_cliente');
        }
    
        protected function AddFieldColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for tipo_operacion field
            //
            $column = new TextViewColumn('tipo_operacion_tipo_operacion', 'Tipo Operacion', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('tipo_operacion', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'tipo_operacion', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('tipo_operacion', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'tipo_operacion', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fecha field
            //
            $column = new DateTimeViewColumn('fecha', 'Fecha', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for fecha field
            //
            $editor = new DateTimeEdit('fecha_edit', false, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha', 'fecha', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for fecha field
            //
            $editor = new DateTimeEdit('fecha_edit', false, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha', 'fecha', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for comprobante field
            //
            $column = new TextViewColumn('comprobante', 'Comprobante', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for comprobante field
            //
            $editor = new TextEdit('comprobante_edit');
            $editor->SetSize(32);
            $editColumn = new CustomEditColumn('Comprobante', 'comprobante', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for comprobante field
            //
            $editor = new TextEdit('comprobante_edit');
            $editor->SetSize(32);
            $editColumn = new CustomEditColumn('Comprobante', 'comprobante', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for deb field
            //
            $column = new TextViewColumn('deb', 'Deb', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for cred field
            //
            $column = new TextViewColumn('cred', 'Cred', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fecha_ins field
            //
            $column = new DateTimeViewColumn('fecha_ins', 'Fecha Ins', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for importe field
            //
            $column = new TextViewColumn('importe', 'Importe', $this->dataset);
            $column->SetOrderable(false);
            
            /* <inline edit column> */
            //
            // Edit column for importe field
            //
            $editor = new TextEdit('importe_edit');
            $editColumn = new CustomEditColumn('Importe', 'importe', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for importe field
            //
            $editor = new TextEdit('importe_edit');
            $editColumn = new CustomEditColumn('Importe', 'importe', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties($column)
        {
            $column->SetShowSetToNullCheckBox(true);
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'public_operacionDetailViewGrid1');
            $result->SetAllowDeleteSelected(false);
            $result->SetUseFixedHeader(false);
            
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $this->AddFieldColumns($result);
    
            return $result;
        }
    }
    
    
    
    ?><?php
    
    ?><?php
    
    class public_operacionDetailEdit1Page extends DetailPageEdit
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."operacion"');
            $field = new IntegerField('id');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('cliente');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('tipo_operacion');
            $this->dataset->AddField($field, false);
            $field = new DateField('fecha');
            $this->dataset->AddField($field, false);
            $field = new StringField('comprobante');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('deb');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('cred');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('fecha_ins');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('importe');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('tipo_operacion', 'public.tipo_operacion', new IntegerField('id'), new StringField('tipo_operacion', 'tipo_operacion_tipo_operacion', 'tipo_operacion_tipo_operacion_public_tipo_operacion'), 'tipo_operacion_tipo_operacion_public_tipo_operacion');
            $this->dataset->AddLookupField('cliente', 'public.v_dd_cliente', new IntegerField('id'), new StringField('descr', 'cliente_descr', 'cliente_descr_public_v_dd_cliente'), 'cliente_descr_public_v_dd_cliente');
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            return null;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl($grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('public_operacionDetailEdit1ssearch', $this->dataset,
                array('id', 'cliente_descr', 'tipo_operacion_tipo_operacion', 'fecha', 'comprobante', 'deb', 'cred', 'fecha_ins', 'importe'),
                array($this->RenderText('Id'), $this->RenderText('Cliente'), $this->RenderText('Tipo Operacion'), $this->RenderText('Fecha'), $this->RenderText('Comprobante'), $this->RenderText('Deb'), $this->RenderText('Cred'), $this->RenderText('Fecha Ins'), $this->RenderText('Importe')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl($grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('public_operacionDetailEdit1asearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id', $this->RenderText('Id')));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."v_dd_cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descr');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('cliente', $this->RenderText('Cliente'), $lookupDataset, 'id', 'descr', false));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('tipo_operacion', $this->RenderText('Tipo Operacion'), $lookupDataset, 'id', 'tipo_operacion', false));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('fecha', $this->RenderText('Fecha')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('comprobante', $this->RenderText('Comprobante')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('deb', $this->RenderText('Deb')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('cred', $this->RenderText('Cred')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('fecha_ins', $this->RenderText('Fecha Ins')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('importe', $this->RenderText('Importe')));
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function AddOperationsColumns($grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = $grid->AddViewColumn(new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset), $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = $grid->AddViewColumn(new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset), $actionsBandName);
                $column->SetImagePath('images/delete_action.png');
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
            $column->SetAdditionalAttribute("modal-delete", "true");
            $column->SetAdditionalAttribute("delete-handler-name", $this->GetModalGridDeleteHandler());
            }
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $column = $grid->AddViewColumn(new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset), $actionsBandName);
                $column->SetImagePath('images/copy_action.png');
            }
        }
    
        protected function AddFieldColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for tipo_operacion field
            //
            $column = new TextViewColumn('tipo_operacion_tipo_operacion', 'Tipo Operacion', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('tipo_operacion', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'tipo_operacion', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('tipo_operacion', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'tipo_operacion', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fecha field
            //
            $column = new DateTimeViewColumn('fecha', 'Fecha', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for fecha field
            //
            $editor = new DateTimeEdit('fecha_edit', false, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha', 'fecha', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for fecha field
            //
            $editor = new DateTimeEdit('fecha_edit', false, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha', 'fecha', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for comprobante field
            //
            $column = new TextViewColumn('comprobante', 'Comprobante', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for comprobante field
            //
            $editor = new TextEdit('comprobante_edit');
            $editor->SetSize(32);
            $editColumn = new CustomEditColumn('Comprobante', 'comprobante', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for comprobante field
            //
            $editor = new TextEdit('comprobante_edit');
            $editor->SetSize(32);
            $editColumn = new CustomEditColumn('Comprobante', 'comprobante', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for deb field
            //
            $column = new TextViewColumn('deb', 'Deb', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for cred field
            //
            $column = new TextViewColumn('cred', 'Cred', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fecha_ins field
            //
            $column = new DateTimeViewColumn('fecha_ins', 'Fecha Ins', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for importe field
            //
            $column = new TextViewColumn('importe', 'Importe', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for importe field
            //
            $editor = new TextEdit('importe_edit');
            $editColumn = new CustomEditColumn('Importe', 'importe', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for importe field
            //
            $editor = new TextEdit('importe_edit');
            $editColumn = new CustomEditColumn('Importe', 'importe', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for descr field
            //
            $column = new TextViewColumn('cliente_descr', 'Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for tipo_operacion field
            //
            $column = new TextViewColumn('tipo_operacion_tipo_operacion', 'Tipo Operacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fecha field
            //
            $column = new DateTimeViewColumn('fecha', 'Fecha', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for comprobante field
            //
            $column = new TextViewColumn('comprobante', 'Comprobante', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for deb field
            //
            $column = new TextViewColumn('deb', 'Deb', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cred field
            //
            $column = new TextViewColumn('cred', 'Cred', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fecha_ins field
            //
            $column = new DateTimeViewColumn('fecha_ins', 'Fecha Ins', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for importe field
            //
            $column = new TextViewColumn('importe', 'Importe', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns($grid)
        {
            //
            // Edit column for id field
            //
            $editor = new TextEdit('id_edit');
            $editColumn = new CustomEditColumn('Id', 'id', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for cliente field
            //
            $editor = new ComboBox('cliente_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."v_dd_cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descr');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('descr', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Cliente', 
                'cliente', 
                $editor, 
                $this->dataset, 'id', 'descr', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('tipo_operacion', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'tipo_operacion', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fecha field
            //
            $editor = new DateTimeEdit('fecha_edit', false, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha', 'fecha', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for comprobante field
            //
            $editor = new TextEdit('comprobante_edit');
            $editor->SetSize(32);
            $editColumn = new CustomEditColumn('Comprobante', 'comprobante', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for deb field
            //
            $editor = new TextEdit('deb_edit');
            $editColumn = new CustomEditColumn('Deb', 'deb', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for cred field
            //
            $editor = new TextEdit('cred_edit');
            $editColumn = new CustomEditColumn('Cred', 'cred', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fecha_ins field
            //
            $editor = new DateTimeEdit('fecha_ins_edit', true, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha Ins', 'fecha_ins', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for importe field
            //
            $editor = new TextEdit('importe_edit');
            $editColumn = new CustomEditColumn('Importe', 'importe', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns($grid)
        {
            //
            // Edit column for cliente field
            //
            $editor = new ComboBox('cliente_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."v_dd_cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descr');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('descr', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Cliente', 
                'cliente', 
                $editor, 
                $this->dataset, 'id', 'descr', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for tipo_operacion field
            //
            $editor = new ComboBox('tipo_operacion_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_operacion"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_operacion');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('tipo_operacion', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Operacion', 
                'tipo_operacion', 
                $editor, 
                $this->dataset, 'id', 'tipo_operacion', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fecha field
            //
            $editor = new DateTimeEdit('fecha_edit', false, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha', 'fecha', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for comprobante field
            //
            $editor = new TextEdit('comprobante_edit');
            $editor->SetSize(32);
            $editColumn = new CustomEditColumn('Comprobante', 'comprobante', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for importe field
            //
            $editor = new TextEdit('importe_edit');
            $editColumn = new CustomEditColumn('Importe', 'importe', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for descr field
            //
            $column = new TextViewColumn('cliente_descr', 'Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for tipo_operacion field
            //
            $column = new TextViewColumn('tipo_operacion_tipo_operacion', 'Tipo Operacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fecha field
            //
            $column = new DateTimeViewColumn('fecha', 'Fecha', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for comprobante field
            //
            $column = new TextViewColumn('comprobante', 'Comprobante', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for deb field
            //
            $column = new TextViewColumn('deb', 'Deb', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for cred field
            //
            $column = new TextViewColumn('cred', 'Cred', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fecha_ins field
            //
            $column = new DateTimeViewColumn('fecha_ins', 'Fecha Ins', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for importe field
            //
            $column = new TextViewColumn('importe', 'Importe', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for descr field
            //
            $column = new TextViewColumn('cliente_descr', 'Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for tipo_operacion field
            //
            $column = new TextViewColumn('tipo_operacion_tipo_operacion', 'Tipo Operacion', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for fecha field
            //
            $column = new DateTimeViewColumn('fecha', 'Fecha', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for comprobante field
            //
            $column = new TextViewColumn('comprobante', 'Comprobante', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for deb field
            //
            $column = new TextViewColumn('deb', 'Deb', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for cred field
            //
            $column = new TextViewColumn('cred', 'Cred', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for fecha_ins field
            //
            $column = new DateTimeViewColumn('fecha_ins', 'Fecha Ins', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for importe field
            //
            $column = new TextViewColumn('importe', 'Importe', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        protected function ApplyCommonColumnEditProperties($column)
        {
            $column->SetShowSetToNullCheckBox(true);
    	$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        
        public function GetModalGridEditingHandler() { return 'public_operacionDetailEdit1_inline_edit'; }
        protected function GetEnableModalGridEditing() { return true; }
        public function ShowDeleteButtonHandler($show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'public_operacionDetailEdit1_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'public_operacionDetailEditGrid1');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
                $result->SetAllowDeleteSelected(true);
            else
                $result->SetAllowDeleteSelected(false);
            ApplyCommonPageSettings($this, $result);
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            
            $result->SetShowLineNumbers(false);
            $result->SetUseModalInserting(true);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
    
            return $result;
        }
        
        protected function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }    
    }
    ?><?php
    
    ?><?php
    
    class public_clientePage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."cliente"');
            $field = new IntegerField('id');
            $this->dataset->AddField($field, true);
            $field = new IntegerField('plan');
            $this->dataset->AddField($field, false);
            $field = new StringField('nro_doc');
            $this->dataset->AddField($field, false);
            $field = new StringField('nombres');
            $this->dataset->AddField($field, false);
            $field = new StringField('apellidos');
            $this->dataset->AddField($field, false);
            $field = new DateField('fecha_ing');
            $this->dataset->AddField($field, false);
            $field = new BooleanField('activo');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('pid');
            $this->dataset->AddField($field, false);
            $field = new StringField('clave');
            $this->dataset->AddField($field, false);
            $field = new StringField('nacionalidad');
            $this->dataset->AddField($field, false);
            $field = new DateField('fecha_nacim');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('tipo_documento');
            $this->dataset->AddField($field, false);
            $field = new StringField('residencia');
            $this->dataset->AddField($field, false);
            $field = new StringField('email');
            $this->dataset->AddField($field, false);
            $field = new StringField('telefono');
            $this->dataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $this->dataset->AddField($field, false);
            $field = new StringField('cod_patrocinador');
            $this->dataset->AddField($field, false);
            $field = new StringField('cod_pid');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('plan', 'public.plan', new IntegerField('id'), new StringField('sigla', 'plan_sigla', 'plan_sigla_public_plan'), 'plan_sigla_public_plan');
            $this->dataset->AddLookupField('tipo_documento', 'public.tipo_documento', new IntegerField('id'), new StringField('sigla', 'tipo_documento_sigla', 'tipo_documento_sigla_public_tipo_documento'), 'tipo_documento_sigla_public_tipo_documento');
            $this->dataset->AddLookupField('nacionalidad', 'public.pais', new StringField('id'), new BooleanField('activo', 'nacionalidad_activo', 'nacionalidad_activo_public_pais'), 'nacionalidad_activo_public_pais');
            $this->dataset->AddLookupField('residencia', 'public.pais', new StringField('id'), new BooleanField('activo', 'residencia_activo', 'residencia_activo_public_pais'), 'residencia_activo_public_pais');
            $this->dataset->AddLookupField('forma_pago', 'public.forma_pago', new StringField('id'), new BooleanField('activo', 'forma_pago_activo', 'forma_pago_activo_public_forma_pago'), 'forma_pago_activo_public_forma_pago');
            $this->dataset->AddLookupField('pid', 'public.v_dd_cliente', new IntegerField('id'), new StringField('descr', 'pid_descr', 'pid_descr_public_v_dd_cliente'), 'pid_descr_public_v_dd_cliente');
            $this->dataset->AddCustomCondition('cliente.id>=0');
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            $currentPageCaption = $this->GetShortCaption();
            $result = new PageList();
            if (GetCurrentUserGrantForDataSource('public.plan')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Planes'), 'public.plan.php', $this->RenderText('Planes'), $currentPageCaption == $this->RenderText('Planes')));
            if (GetCurrentUserGrantForDataSource('public.tipo_documento')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tipos Documentos'), 'public.tipo_documento.php', $this->RenderText('Tipos Documentos'), $currentPageCaption == $this->RenderText('Tipos Documentos')));
            if (GetCurrentUserGrantForDataSource('public.tipo_operacion')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Tipos de Operaciones'), 'public.tipo_operacion.php', $this->RenderText('Tipos de Operaciones'), $currentPageCaption == $this->RenderText('Tipos de Operaciones')));
            if (GetCurrentUserGrantForDataSource('public.cliente')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Clientes'), 'public.cliente.php', $this->RenderText('Clientes'), $currentPageCaption == $this->RenderText('Clientes')));
            if (GetCurrentUserGrantForDataSource('public.forma_pago')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Forma Pago'), 'public.forma_pago.php', $this->RenderText('Forma Pago'), $currentPageCaption == $this->RenderText('Forma Pago')));
            if (GetCurrentUserGrantForDataSource('public.pais')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Pais'), 'public.pais.php', $this->RenderText('Pais'), $currentPageCaption == $this->RenderText('Pais')));
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl($grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('public_clientessearch', $this->dataset,
                array('id', 'activo', 'plan_sigla', 'tipo_documento_sigla', 'nro_doc', 'nombres', 'apellidos', 'fecha_nacim', 'email', 'telefono', 'nacionalidad_activo', 'residencia_activo', 'forma_pago_activo', 'cod_patrocinador', 'cod_pid', 'pid_descr', 'fecha_ing'),
                array($this->RenderText('Id'), $this->RenderText('Activo'), $this->RenderText('Plan'), $this->RenderText('Tipo Documento'), $this->RenderText('Nro Documento'), $this->RenderText('Nombres'), $this->RenderText('Apellidos'), $this->RenderText('Fecha Nacim'), $this->RenderText('Email'), $this->RenderText('Telefono'), $this->RenderText('Nacionalidad'), $this->RenderText('Residencia'), $this->RenderText('Forma Pago'), $this->RenderText('Cod Patrocinador'), $this->RenderText('Cod Pid'), $this->RenderText('Proponente'), $this->RenderText('Fecha Ing')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl($grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('public_clienteasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id', $this->RenderText('Id')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('activo', $this->RenderText('Activo')));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."plan"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('plan');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('distribucion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('inscripcion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('minimo_mensual');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('maximo');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('plan', $this->RenderText('Plan'), $lookupDataset, 'id', 'sigla', false));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_documento"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('tipo_documento', $this->RenderText('Tipo Documento'), $lookupDataset, 'id', 'sigla', false));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('nro_doc', $this->RenderText('Nro Documento')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('nombres', $this->RenderText('Nombres')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('apellidos', $this->RenderText('Apellidos')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('fecha_nacim', $this->RenderText('Fecha Nacim')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('email', $this->RenderText('Email')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('telefono', $this->RenderText('Telefono')));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."pais"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_de');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('nacionalidad', $this->RenderText('Nacionalidad'), $lookupDataset, 'id', 'activo', false));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."pais"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_de');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('residencia', $this->RenderText('Residencia'), $lookupDataset, 'id', 'activo', false));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."forma_pago"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('forma_pago', $this->RenderText('Forma Pago'), $lookupDataset, 'id', 'activo', false));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('cod_patrocinador', $this->RenderText('Cod Patrocinador')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('cod_pid', $this->RenderText('Cod Pid')));
            
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."v_dd_cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descr');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('pid', $this->RenderText('Proponente'), $lookupDataset, 'id', 'descr', false));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('fecha_ing', $this->RenderText('Fecha Ing')));
        }
    
        protected function AddOperationsColumns($grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = $grid->AddViewColumn(new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset), $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = $grid->AddViewColumn(new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset), $actionsBandName);
                $column->SetImagePath('images/edit_action.png');
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = $grid->AddViewColumn(new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset), $actionsBandName);
                $column->SetImagePath('images/delete_action.png');
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
            $column->SetAdditionalAttribute("modal-delete", "true");
            $column->SetAdditionalAttribute("delete-handler-name", $this->GetModalGridDeleteHandler());
            }
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $column = $grid->AddViewColumn(new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset), $actionsBandName);
                $column->SetImagePath('images/copy_action.png');
            }
        }
    
        protected function AddFieldColumns($grid)
        {
            if (GetCurrentUserGrantForDataSource('public_movDetailView0')->HasViewGrant())
            {
              //
            // View column for public_movDetailView0 detail
            //
            $column = new DetailColumn(array('id'), 'detail0', 'public_movDetailEdit0_handler', 'public_movDetailView0_handler', $this->dataset, 'Distribucion');
              $grid->AddViewColumn($column);
            }
            
            if (GetCurrentUserGrantForDataSource('public_operacionDetailView1')->HasViewGrant())
            {
              //
            // View column for public_operacionDetailView1 detail
            //
            $column = new DetailColumn(array('id'), 'detail1', 'public_operacionDetailEdit1_handler', 'public_operacionDetailView1_handler', $this->dataset, 'Operaciones');
              $grid->AddViewColumn($column);
            }
            
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('activo', 'Activo', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for activo field
            //
            $editor = new CheckBox('activo_edit');
            $editColumn = new CustomEditColumn('Activo', 'activo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for activo field
            //
            $editor = new CheckBox('activo_edit');
            $editColumn = new CustomEditColumn('Activo', 'activo', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues('<img src="images/checked.png" alt="true">', '');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('plan_sigla', 'Plan', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for plan field
            //
            $editor = new ComboBox('plan_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."plan"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('plan');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('distribucion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('inscripcion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('minimo_mensual');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('maximo');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Plan', 
                'plan', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for plan field
            //
            $editor = new ComboBox('plan_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."plan"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('plan');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('distribucion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('inscripcion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('minimo_mensual');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('maximo');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Plan', 
                'plan', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_documento_sigla', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for tipo_documento field
            //
            $editor = new ComboBox('tipo_documento_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_documento"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Documento', 
                'tipo_documento', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for tipo_documento field
            //
            $editor = new ComboBox('tipo_documento_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_documento"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Documento', 
                'tipo_documento', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for nro_doc field
            //
            $column = new TextViewColumn('nro_doc', 'Nro Documento', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for nro_doc field
            //
            $editor = new TextEdit('nro_doc_edit');
            $editor->SetSize(32);
            $editColumn = new CustomEditColumn('Nro Documento', 'nro_doc', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for nro_doc field
            //
            $editor = new TextEdit('nro_doc_edit');
            $editor->SetSize(32);
            $editColumn = new CustomEditColumn('Nro Documento', 'nro_doc', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for nombres field
            //
            $column = new TextViewColumn('nombres', 'Nombres', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('nombres_handler');
            
            /* <inline edit column> */
            //
            // Edit column for nombres field
            //
            $editor = new TextAreaEdit('nombres_edit', 50, 8);
            $editColumn = new CustomEditColumn('Nombres', 'nombres', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for nombres field
            //
            $editor = new TextAreaEdit('nombres_edit', 50, 8);
            $editColumn = new CustomEditColumn('Nombres', 'nombres', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for apellidos field
            //
            $column = new TextViewColumn('apellidos', 'Apellidos', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('apellidos_handler');
            
            /* <inline edit column> */
            //
            // Edit column for apellidos field
            //
            $editor = new TextAreaEdit('apellidos_edit', 50, 8);
            $editColumn = new CustomEditColumn('Apellidos', 'apellidos', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for apellidos field
            //
            $editor = new TextAreaEdit('apellidos_edit', 50, 8);
            $editColumn = new CustomEditColumn('Apellidos', 'apellidos', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fecha_nacim field
            //
            $column = new DateTimeViewColumn('fecha_nacim', 'Fecha Nacim', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for fecha_nacim field
            //
            $editor = new DateTimeEdit('fecha_nacim_edit', false, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha Nacim', 'fecha_nacim', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for fecha_nacim field
            //
            $editor = new DateTimeEdit('fecha_nacim_edit', false, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha Nacim', 'fecha_nacim', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('email_handler');
            
            /* <inline edit column> */
            //
            // Edit column for email field
            //
            $editor = new TextAreaEdit('email_edit', 50, 8);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for email field
            //
            $editor = new TextAreaEdit('email_edit', 50, 8);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for telefono field
            //
            $column = new TextViewColumn('telefono', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('telefono_handler');
            
            /* <inline edit column> */
            //
            // Edit column for telefono field
            //
            $editor = new TextAreaEdit('telefono_edit', 50, 8);
            $editColumn = new CustomEditColumn('Telefono', 'telefono', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for telefono field
            //
            $editor = new TextAreaEdit('telefono_edit', 50, 8);
            $editColumn = new CustomEditColumn('Telefono', 'telefono', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('nacionalidad_activo', 'Nacionalidad', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for nacionalidad field
            //
            $editor = new ComboBox('nacionalidad_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."pais"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_de');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Nacionalidad', 
                'nacionalidad', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for nacionalidad field
            //
            $editor = new ComboBox('nacionalidad_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."pais"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_de');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Nacionalidad', 
                'nacionalidad', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('residencia_activo', 'Residencia', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for residencia field
            //
            $editor = new ComboBox('residencia_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."pais"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_de');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Residencia', 
                'residencia', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for residencia field
            //
            $editor = new ComboBox('residencia_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."pais"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_de');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Residencia', 
                'residencia', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('forma_pago_activo', 'Forma Pago', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for forma_pago field
            //
            $editor = new ComboBox('forma_pago_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."forma_pago"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Forma Pago', 
                'forma_pago', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for forma_pago field
            //
            $editor = new ComboBox('forma_pago_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."forma_pago"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Forma Pago', 
                'forma_pago', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for cod_patrocinador field
            //
            $column = new TextViewColumn('cod_patrocinador', 'Cod Patrocinador', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for cod_pid field
            //
            $column = new TextViewColumn('cod_pid', 'Cod Pid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for descr field
            //
            $column = new TextViewColumn('pid_descr', 'Proponente', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for pid field
            //
            $editor = new ComboBox('pid_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."v_dd_cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descr');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('descr', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Proponente', 
                'pid', 
                $editor, 
                $this->dataset, 'id', 'descr', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for pid field
            //
            $editor = new ComboBox('pid_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."v_dd_cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descr');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('descr', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Proponente', 
                'pid', 
                $editor, 
                $this->dataset, 'id', 'descr', $lookupDataset);
            $editColumn->SetAllowSetToDefault(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for fecha_ing field
            //
            $column = new DateTimeViewColumn('fecha_ing', 'Fecha Ing', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for fecha_ing field
            //
            $editor = new DateTimeEdit('fecha_ing_edit', false, 'Y-m-d', 1);
            $editColumn = new CustomEditColumn('Fecha Ing', 'fecha_ing', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for fecha_ing field
            //
            $editor = new DateTimeEdit('fecha_ing_edit', false, 'Y-m-d', 1);
            $editColumn = new CustomEditColumn('Fecha Ing', 'fecha_ing', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('activo', 'Activo', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues('<img src="images/checked.png" alt="true">', '');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('plan_sigla', 'Plan', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_documento_sigla', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nro_doc field
            //
            $column = new TextViewColumn('nro_doc', 'Nro Documento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nombres field
            //
            $column = new TextViewColumn('nombres', 'Nombres', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('nombres_handler');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for apellidos field
            //
            $column = new TextViewColumn('apellidos', 'Apellidos', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('apellidos_handler');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fecha_nacim field
            //
            $column = new DateTimeViewColumn('fecha_nacim', 'Fecha Nacim', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('email_handler');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for telefono field
            //
            $column = new TextViewColumn('telefono', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('telefono_handler');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('nacionalidad_activo', 'Nacionalidad', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('residencia_activo', 'Residencia', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('forma_pago_activo', 'Forma Pago', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cod_patrocinador field
            //
            $column = new TextViewColumn('cod_patrocinador', 'Cod Patrocinador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cod_pid field
            //
            $column = new TextViewColumn('cod_pid', 'Cod Pid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for descr field
            //
            $column = new TextViewColumn('pid_descr', 'Proponente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fecha_ing field
            //
            $column = new DateTimeViewColumn('fecha_ing', 'Fecha Ing', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns($grid)
        {
            //
            // Edit column for activo field
            //
            $editor = new CheckBox('activo_edit');
            $editColumn = new CustomEditColumn('Activo', 'activo', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for plan field
            //
            $editor = new ComboBox('plan_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."plan"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('plan');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('distribucion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('inscripcion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('minimo_mensual');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('maximo');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Plan', 
                'plan', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for tipo_documento field
            //
            $editor = new ComboBox('tipo_documento_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_documento"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Documento', 
                'tipo_documento', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for nro_doc field
            //
            $editor = new TextEdit('nro_doc_edit');
            $editor->SetSize(32);
            $editColumn = new CustomEditColumn('Nro Documento', 'nro_doc', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for nombres field
            //
            $editor = new TextAreaEdit('nombres_edit', 50, 8);
            $editColumn = new CustomEditColumn('Nombres', 'nombres', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for apellidos field
            //
            $editor = new TextAreaEdit('apellidos_edit', 50, 8);
            $editColumn = new CustomEditColumn('Apellidos', 'apellidos', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fecha_nacim field
            //
            $editor = new DateTimeEdit('fecha_nacim_edit', false, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha Nacim', 'fecha_nacim', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextAreaEdit('email_edit', 50, 8);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for telefono field
            //
            $editor = new TextAreaEdit('telefono_edit', 50, 8);
            $editColumn = new CustomEditColumn('Telefono', 'telefono', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for nacionalidad field
            //
            $editor = new ComboBox('nacionalidad_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."pais"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_de');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Nacionalidad', 
                'nacionalidad', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for residencia field
            //
            $editor = new ComboBox('residencia_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."pais"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_de');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Residencia', 
                'residencia', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for forma_pago field
            //
            $editor = new ComboBox('forma_pago_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."forma_pago"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Forma Pago', 
                'forma_pago', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for clave field
            //
            $editor = new TextAreaEdit('clave_edit', 50, 8);
            $editColumn = new CustomEditColumn('Clave', 'clave', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns($grid)
        {
            //
            // Edit column for activo field
            //
            $editor = new CheckBox('activo_edit');
            $editColumn = new CustomEditColumn('Activo', 'activo', $editor, $this->dataset);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for plan field
            //
            $editor = new ComboBox('plan_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."plan"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('plan');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('distribucion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('inscripcion');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('minimo_mensual');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('maximo');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Plan', 
                'plan', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for tipo_documento field
            //
            $editor = new ComboBox('tipo_documento_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."tipo_documento"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, true);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $field = new StringField('tipo_documento');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('sigla', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Tipo Documento', 
                'tipo_documento', 
                $editor, 
                $this->dataset, 'id', 'sigla', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for nro_doc field
            //
            $editor = new TextEdit('nro_doc_edit');
            $editor->SetSize(32);
            $editColumn = new CustomEditColumn('Nro Documento', 'nro_doc', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for nombres field
            //
            $editor = new TextAreaEdit('nombres_edit', 50, 8);
            $editColumn = new CustomEditColumn('Nombres', 'nombres', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for apellidos field
            //
            $editor = new TextAreaEdit('apellidos_edit', 50, 8);
            $editColumn = new CustomEditColumn('Apellidos', 'apellidos', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fecha_nacim field
            //
            $editor = new DateTimeEdit('fecha_nacim_edit', false, 'Y-m-d H:i:s', 0);
            $editColumn = new CustomEditColumn('Fecha Nacim', 'fecha_nacim', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for email field
            //
            $editor = new TextAreaEdit('email_edit', 50, 8);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for telefono field
            //
            $editor = new TextAreaEdit('telefono_edit', 50, 8);
            $editColumn = new CustomEditColumn('Telefono', 'telefono', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for nacionalidad field
            //
            $editor = new ComboBox('nacionalidad_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."pais"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_de');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Nacionalidad', 
                'nacionalidad', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for residencia field
            //
            $editor = new ComboBox('residencia_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."pais"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_es');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('pais_de');
            $lookupDataset->AddField($field, false);
            $field = new StringField('nacionalidad_de');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Residencia', 
                'residencia', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for forma_pago field
            //
            $editor = new ComboBox('forma_pago_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."forma_pago"');
            $field = new StringField('id');
            $lookupDataset->AddField($field, true);
            $field = new BooleanField('activo');
            $lookupDataset->AddField($field, false);
            $field = new StringField('forma_pago');
            $lookupDataset->AddField($field, false);
            $field = new StringField('sigla');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('activo', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Forma Pago', 
                'forma_pago', 
                $editor, 
                $this->dataset, 'id', 'activo', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for pid field
            //
            $editor = new ComboBox('pid_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new PgConnectionFactory(),
                GetConnectionOptions(),
                '"public"."v_dd_cliente"');
            $field = new IntegerField('id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descr');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('pid');
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('descr', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Proponente', 
                'pid', 
                $editor, 
                $this->dataset, 'id', 'descr', $lookupDataset);
            $editColumn->SetAllowSetToDefault(true);
            $editColumn->SetInsertDefaultValue('0');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for clave field
            //
            $editor = new TextAreaEdit('clave_edit', 50, 8);
            $editColumn = new CustomEditColumn('Clave', 'clave', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fecha_ing field
            //
            $editor = new DateTimeEdit('fecha_ing_edit', false, 'Y-m-d', 1);
            $editColumn = new CustomEditColumn('Fecha Ing', 'fecha_ing', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('activo', 'Activo', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues('<img src="images/checked.png" alt="true">', '');
            $grid->AddPrintColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('plan_sigla', 'Plan', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_documento_sigla', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for nro_doc field
            //
            $column = new TextViewColumn('nro_doc', 'Nro Documento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for nombres field
            //
            $column = new TextViewColumn('nombres', 'Nombres', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for apellidos field
            //
            $column = new TextViewColumn('apellidos', 'Apellidos', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fecha_nacim field
            //
            $column = new DateTimeViewColumn('fecha_nacim', 'Fecha Nacim', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for telefono field
            //
            $column = new TextViewColumn('telefono', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('nacionalidad_activo', 'Nacionalidad', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('residencia_activo', 'Residencia', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('forma_pago_activo', 'Forma Pago', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for cod_patrocinador field
            //
            $column = new TextViewColumn('cod_patrocinador', 'Cod Patrocinador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for cod_pid field
            //
            $column = new TextViewColumn('cod_pid', 'Cod Pid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for descr field
            //
            $column = new TextViewColumn('pid_descr', 'Proponente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fecha_ing field
            //
            $column = new DateTimeViewColumn('fecha_ing', 'Fecha Ing', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns($grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('activo', 'Activo', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues('<img src="images/checked.png" alt="true">', '');
            $grid->AddExportColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('plan_sigla', 'Plan', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_documento_sigla', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for nro_doc field
            //
            $column = new TextViewColumn('nro_doc', 'Nro Documento', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for nombres field
            //
            $column = new TextViewColumn('nombres', 'Nombres', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for apellidos field
            //
            $column = new TextViewColumn('apellidos', 'Apellidos', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for fecha_nacim field
            //
            $column = new DateTimeViewColumn('fecha_nacim', 'Fecha Nacim', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for telefono field
            //
            $column = new TextViewColumn('telefono', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('nacionalidad_activo', 'Nacionalidad', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('residencia_activo', 'Residencia', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('forma_pago_activo', 'Forma Pago', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for cod_patrocinador field
            //
            $column = new TextViewColumn('cod_patrocinador', 'Cod Patrocinador', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for cod_pid field
            //
            $column = new TextViewColumn('cod_pid', 'Cod Pid', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for descr field
            //
            $column = new TextViewColumn('pid_descr', 'Proponente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for fecha_ing field
            //
            $column = new DateTimeViewColumn('fecha_ing', 'Fecha Ing', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties($column)
        {
            $column->SetShowSetToNullCheckBox(true);
    	$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function CreateMasterDetailRecordGridForpublic_movDetailEdit0Grid()
        {
            $result = new Grid($this, $this->dataset, 'MasterDetailRecordGridForpublic_movDetailEdit0');
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetEnabledInlineEditing(false);
            $result->SetName('master_grid');
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('activo', 'Activo', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues('<img src="images/checked.png" alt="true">', '');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('plan_sigla', 'Plan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_documento_sigla', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for nro_doc field
            //
            $column = new TextViewColumn('nro_doc', 'Nro Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for nombres field
            //
            $column = new TextViewColumn('nombres', 'Nombres', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('nombres_handler');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for apellidos field
            //
            $column = new TextViewColumn('apellidos', 'Apellidos', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('apellidos_handler');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for fecha_nacim field
            //
            $column = new DateTimeViewColumn('fecha_nacim', 'Fecha Nacim', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('email_handler');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for telefono field
            //
            $column = new TextViewColumn('telefono', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('telefono_handler');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('nacionalidad_activo', 'Nacionalidad', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('residencia_activo', 'Residencia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('forma_pago_activo', 'Forma Pago', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for cod_patrocinador field
            //
            $column = new TextViewColumn('cod_patrocinador', 'Cod Patrocinador', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for cod_pid field
            //
            $column = new TextViewColumn('cod_pid', 'Cod Pid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for descr field
            //
            $column = new TextViewColumn('pid_descr', 'Proponente', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for fecha_ing field
            //
            $column = new DateTimeViewColumn('fecha_ing', 'Fecha Ing', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            return $result;
        }
        function CreateMasterDetailRecordGridForpublic_operacionDetailEdit1Grid()
        {
            $result = new Grid($this, $this->dataset, 'MasterDetailRecordGridForpublic_operacionDetailEdit1');
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetEnabledInlineEditing(false);
            $result->SetName('master_grid');
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('activo', 'Activo', $this->dataset);
            $column->SetOrderable(true);
            $column = new CheckBoxFormatValueViewColumnDecorator($column);
            $column->SetDisplayValues('<img src="images/checked.png" alt="true">', '');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('plan_sigla', 'Plan', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for sigla field
            //
            $column = new TextViewColumn('tipo_documento_sigla', 'Tipo Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for nro_doc field
            //
            $column = new TextViewColumn('nro_doc', 'Nro Documento', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for nombres field
            //
            $column = new TextViewColumn('nombres', 'Nombres', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('nombres_handler');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for apellidos field
            //
            $column = new TextViewColumn('apellidos', 'Apellidos', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('apellidos_handler');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for fecha_nacim field
            //
            $column = new DateTimeViewColumn('fecha_nacim', 'Fecha Nacim', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('email_handler');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for telefono field
            //
            $column = new TextViewColumn('telefono', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('telefono_handler');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('nacionalidad_activo', 'Nacionalidad', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('residencia_activo', 'Residencia', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for activo field
            //
            $column = new TextViewColumn('forma_pago_activo', 'Forma Pago', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for cod_patrocinador field
            //
            $column = new TextViewColumn('cod_patrocinador', 'Cod Patrocinador', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for cod_pid field
            //
            $column = new TextViewColumn('cod_pid', 'Cod Pid', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for descr field
            //
            $column = new TextViewColumn('pid_descr', 'Proponente', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for fecha_ing field
            //
            $column = new DateTimeViewColumn('fecha_ing', 'Fecha Ing', $this->dataset);
            $column->SetDateTimeFormat('Y-m-d');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            return $result;
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function ShowEditButtonHandler($show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler($show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'public_cliente_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'public_clienteGrid');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(true);
            $result->SetWidth('');
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(true);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
            $handler = new PageHTTPHandler('public_movDetailView0_handler', new public_movDetailView0Page('Distribucion', 'Distribucion', array('cliente'), GetCurrentUserGrantForDataSource('public_movDetailView0'), 'UTF-8', 20, 'public_movDetailEdit0_handler'));
            GetApplication()->RegisterHTTPHandler($handler);
            $pageEdit = new public_movDetailEdit0Page($this, array('cliente'), array('id'), $this->GetForeingKeyFields(), $this->CreateMasterDetailRecordGridForpublic_movDetailEdit0Grid(), $this->dataset, GetCurrentUserGrantForDataSource('public_movDetailEdit0'), 'UTF-8');
            $pageEdit->SetShortCaption('Distribucion');
            $pageEdit->SetHeader(GetPagesHeader());
            $pageEdit->SetFooter(GetPagesFooter());
            $pageEdit->SetCaption('Distribucion');
            $pageEdit->SetHttpHandlerName('public_movDetailEdit0_handler');
            $handler = new PageHTTPHandler('public_movDetailEdit0_handler', $pageEdit);
            GetApplication()->RegisterHTTPHandler($handler);
            $handler = new PageHTTPHandler('public_operacionDetailView1_handler', new public_operacionDetailView1Page('Operaciones', 'Operaciones', array('cliente'), GetCurrentUserGrantForDataSource('public_operacionDetailView1'), 'UTF-8', 20, 'public_operacionDetailEdit1_handler'));
            GetApplication()->RegisterHTTPHandler($handler);
            $pageEdit = new public_operacionDetailEdit1Page($this, array('cliente'), array('id'), $this->GetForeingKeyFields(), $this->CreateMasterDetailRecordGridForpublic_operacionDetailEdit1Grid(), $this->dataset, GetCurrentUserGrantForDataSource('public_operacionDetailEdit1'), 'UTF-8');
            $pageEdit->SetShortCaption('Operaciones');
            $pageEdit->SetHeader(GetPagesHeader());
            $pageEdit->SetFooter(GetPagesFooter());
            $pageEdit->SetCaption('Operaciones');
            $pageEdit->SetHttpHandlerName('public_operacionDetailEdit1_handler');
            $handler = new PageHTTPHandler('public_operacionDetailEdit1_handler', $pageEdit);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for nombres field
            //
            $column = new TextViewColumn('nombres', 'Nombres', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for nombres field
            //
            $editor = new TextAreaEdit('nombres_edit', 50, 8);
            $editColumn = new CustomEditColumn('Nombres', 'nombres', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for nombres field
            //
            $editor = new TextAreaEdit('nombres_edit', 50, 8);
            $editColumn = new CustomEditColumn('Nombres', 'nombres', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'nombres_handler', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for apellidos field
            //
            $column = new TextViewColumn('apellidos', 'Apellidos', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for apellidos field
            //
            $editor = new TextAreaEdit('apellidos_edit', 50, 8);
            $editColumn = new CustomEditColumn('Apellidos', 'apellidos', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for apellidos field
            //
            $editor = new TextAreaEdit('apellidos_edit', 50, 8);
            $editColumn = new CustomEditColumn('Apellidos', 'apellidos', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'apellidos_handler', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for email field
            //
            $editor = new TextAreaEdit('email_edit', 50, 8);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for email field
            //
            $editor = new TextAreaEdit('email_edit', 50, 8);
            $editColumn = new CustomEditColumn('Email', 'email', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'email_handler', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for telefono field
            //
            $column = new TextViewColumn('telefono', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for telefono field
            //
            $editor = new TextAreaEdit('telefono_edit', 50, 8);
            $editColumn = new CustomEditColumn('Telefono', 'telefono', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for telefono field
            //
            $editor = new TextAreaEdit('telefono_edit', 50, 8);
            $editColumn = new CustomEditColumn('Telefono', 'telefono', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'telefono_handler', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for nombres field
            //
            $column = new TextViewColumn('nombres', 'Nombres', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'nombres_handler', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for apellidos field
            //
            $column = new TextViewColumn('apellidos', 'Apellidos', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'apellidos_handler', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for email field
            //
            $column = new TextViewColumn('email', 'Email', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'email_handler', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for telefono field
            //
            $column = new TextViewColumn('telefono', 'Telefono', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'telefono_handler', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        protected function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }
    }

    SetUpUserAuthorization(GetApplication());

    try
    {
        $Page = new public_clientePage("public.cliente.php", "public_cliente", GetCurrentUserGrantForDataSource("public_cliente"), 'UTF-8');
        $Page->SetShortCaption('Clientes');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Clientes');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("public_cliente"));

        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e->getMessage());
    }

?>
