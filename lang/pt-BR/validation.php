<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'O campo :attribute  deve ser aceito.',
    'accepted_if' => 'O campo :attribute  deve ser aceito quando :other é :value.',
    'active_url' => 'O campo :attribute não é uma URL válida.',
    'after' => 'O campo :attribute deve ser uma data posterior a :date.',
    'after_or_equal' => 'O campo :attribute deve ser uma data superior ou igual a :date.',
    'alpha' => 'O campo :attribute deve ser apenas letras.',
    'alpha_dash' => 'O campo :attribute só pode conter letras, números e traços.',
    'alpha_num' => 'O campo :attribute só pode conter letras e números.',
    'array' => 'O campo :attribute deve conter um array.',
    'ascii' => 'O campo :attribute deve conter apenas caracteres alfanuméricos de byte único e símbolos.',
    'before' => 'O campo :attribute deve ser uma data anterior a :date.',
    'before_or_equal' => 'O campo :attribute deve ser uma data anterior ou igual a :date.',
    'between' => [
        'array' => 'O campo :attribute deve ter itens entre :min e :max.',
        'file' => 'O campo :attribute deve estar entre :min e :max kilobytes.',
        'numeric' => 'O campo :attribute deve estar entre :min e :max.',
        'string' => 'O campo :attribute deve estar entre :min e :max caracteres.',
    ],
    'boolean' => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação do campo :attribute não corresponde.',
    'current_password' => 'A senha está incorreta.',
    'date' => 'O campo :attribute deve ser uma data válida.',
    'date_equals' => 'O campo :attribute deve ser uma data igual a :date.',
    'date_format' => 'O campo :attribute deve corresponder ao formato :format.',
    'decimal' => 'O campo :attribute deve ter :decimal casas decimais.',
    'declined' => 'O campo :attribute deve ser recusado.',
    'declined_if' => 'O campo :attribute deve ser recusado quando :other for :value.',
    'different' => 'O campo :attribute e :other devem ser diferentes.',
    'digits' => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between' => 'O campo :attribute deve estar entre :min e :max dígitos.',
    'dimensions' => 'O campo :attribute tem dimensões de imagem inválidas.',
    'distinct' => 'O campo :attribute tem um valor duplicado.',
    'doesnt_end_with' => 'O campo :attribute não deve terminar com um dos seguintes: :values.',
    'doesnt_start_with' => 'O campo :attribute não deve começar com um dos seguintes: :values.',
    'email' => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'ends_with' => 'O campo :attribute deve terminar com um dos seguintes: :values.',
    'enum' => 'O :attribute selecionado é inválido.',
    'exists' => 'O :attribute selecionado é inválido.',
    'file' => 'O campo :attribute deve ser um arquivo.',
    'filled' => 'O campo :attribute deve ter um valor.',
    'gt' => [
        'array' => 'O campo :attribute deve ter mais de itens :value.',
        'file' => 'O campo :attribute deve ser maior que :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'string' => 'O campo :attribute deve ser maior que os caracteres :value.',
    ],
    'gte' => [
        'array' => 'O campo :attribute deve ter itens :value ou mais.',
        'file' => 'O campo :attribute deve ser maior ou igual a :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'string' => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
    ],
    'image' => 'O campo :attribute deve ser uma imagem.',
    'in' => 'O :attribute selecionado é inválido.',
    'in_array' => 'O campo :attribute deve existir em :other.',
    'integer' => 'O campo :attribute deve ser um número inteiro.',
    'ip' => 'O campo :attribute deve ser um endereço IP válido.',
    'ipv4' => 'O campo :attribute deve ser um endereço IPv4 válido.',
    'ipv6' => 'O campo :attribute deve ser um endereço IPv6 válido.',
    'json' => 'O campo :attribute deve ser uma string JSON válida.',
    'lowercase' => 'O campo :attribute deve estar em letras minúsculas.',
    'lt' => [
        'array' => 'The :attribute field must have less than :value items.',
        'file' => 'O campo :attribute deve ser menor que :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'string' => 'O campo :attribute deve ter menos de :value caracteres.',
    ],
    'lte' => [
        'array' => 'O campo :attribute não deve ter mais do que :value itens.',
        'file' => 'O campo :attribute deve ser menor ou igual a :value kilobytes.',
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
        'string' => 'O campo :attribute deve ser menor ou igual a :value caracteres.',
    ],
    'mac_address' => 'O campo :attribute deve ser um endereço MAC válido.',
    'max' => [
        'array' => 'O campo :attribute não deve ter mais que :max items.',
        'file' => 'O campo :attribute não deve ser maior que :max kilobytes.',
        'numeric' => 'O campo :attribute não deve ser maior que :max.',
        'string' => 'O campo :attribute não deve ser maior que :max caracteres.',
    ],
    'max_digits' => 'O campo :attribute não deve ter mais de :max dígitos.',
    'mimes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min' => [
        'array' => 'O campo :attribute deve ter pelo menos :min itens.',
        'file' => 'O campo :attribute deve ter pelo menos :min kilobytes.',
        'numeric' => 'O campo :attribute deve ser pelo menos :min.',
        'string' => 'O campo :attribute deve ter pelo menos :min caracteres.',
    ],
    'min_digits' => 'O campo :attribute deve ter pelo menos :min dígitos.',
    'missing' => 'O campo :attribute deve estar ausente.',
    'missing_if' => 'O campo :attribute deve estar ausente quando :other for :value.',
    'missing_unless' => 'O campo :attribute deve estar ausente, a menos que :other seja :value.',
    'missing_with' => 'O campo :attribute deve estar ausente quando :values estiver presente.',
    'missing_with_all' => 'O campo :attribute deve estar ausente quando :values estiver presente.',
    'multiple_of' => 'O campo :attribute deve ser um múltiplo de :value.',
    'not_in' => 'O :attribute selecionado é inválido.',
    'not_regex' => 'O formato do campo :attribute é inválido.',
    'numeric' => 'O campo :attribute deve ser um número.',
    'password' => [
        'letters' => 'O campo :attribute deve conter pelo menos uma letra.',
        'mixed' => 'O campo :attribute deve conter pelo menos uma letra maiúscula e uma minúscula.',
        'numbers' => 'O campo :attribute deve conter pelo menos um número.',
        'symbols' => 'O campo :attribute deve conter pelo menos um símbolo.',
        'uncompromised' => 'O dado :attribute apareceu em um vazamento de dados. Escolha um :attribute diferente.',
    ],
    'present' => 'O campo :attribute deve estar presente.',
    'prohibited' => 'O campo :attribute é proibido.',
    'prohibited_if' => 'O campo :attribute é proibido quando :other é :value.',
    'prohibited_unless' => 'O campo :attribute é proibido a menos que :other esteja em :values.',
    'prohibits' => 'O campo :attribute proíbe :other de estar presente.',
    'regex' => 'O formato do campo :attribute é inválido.',
    'required' => 'O campo :attribute é obrigatório.',
    'required_array_keys' => 'O campo :attribute deve conter entradas para: :values.',
    'required_if' => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_if_accepted' => 'O campo :attribute é obrigatório quando :other é aceito.',
    'required_unless' => 'O campo :attribute é obrigatório, a menos que :other esteja em :values.',
    'required_with' => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all' => 'O campo :attribute é obrigatório quando :values estão presentes.',
    'required_without' => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values está presente.',
    'same' => 'O campo :attribute deve corresponder a :other.',
    'size' => [
        'array' => 'O campo :attribute deve conter itens :size.',
        'file' => 'O campo :attribute deve ser :size kilobytes.',
        'numeric' => 'O campo :attribute deve ser :size.',
        'string' => 'O campo :attribute deve ter caracteres :size.',
    ],
    'starts_with' => 'O campo :attribute deve começar com um dos seguintes: :values.',
    'string' => 'O campo :attribute deve ser uma string.',
    'timezone' => 'O campo :attribute deve ser um fuso horário válido.',
    'unique' => 'O campo :attribute já foi usado.',
    'uploaded' => 'O :attribute falhou ao carregar.',
    'uppercase' => 'O campo :attribute deve estar em letras maiúsculas.',
    'url' => 'O campo :attribute deve ser um URL válido.',
    'ulid' => 'O campo :attribute deve ser um ULID válido.',
    'uuid' => 'O campo :attribute deve ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'address' => 'endereço',
        'age' => 'idade',
        'body' => 'conteúdo',
        'city' => 'cidade',
        'country' => 'país',
        'date' => 'data',
        'day' => 'dia',
        'description' => 'descrição',
        'excerpt' => 'resumo',
        'first_name' => 'primeiro nome',
        'gender' => 'gênero',
        'hour' => 'hora',
        'last_name' => 'sobrenome',
        'message' => 'mensagem',
        'minute' => 'minuto',
        'mobile' => 'celular',
        'month' => 'mês',
        'name' => 'nome',
        'password_confirmation' => 'confirmação da senha',
        'password' => 'senha',
        'phone' => 'telefone',
        'second' => 'segundo',
        'sex' => 'sexo',
        'state' => 'estado',
        'subject' => 'assunto',
        'text' => 'texto',
        'time' => 'hora',
        'title' => 'título',
        'username' => 'usuário',
        'year' => 'ano',
        'group' => 'grupo',

        /**Usuário */
        'user_type' => 'tipo de usuário',

        /**Secretária */
        'secretary_name' => 'nome da secretária',
        'secretary_acronym' => 'sigla',
        'secretary' => 'secretária',

        /**Diretoria */
        'directorate' => 'diretoria',
        'directorate_name' => 'nome da diretoria',


        /** Permissões */
        'role' => 'perfil',
        'permission' => 'permissão',


        /** Patrimônios */
        'patrimony_location_name' => 'nome do local',
        'patrimony_asset_name' => 'nome do bem',
        'requester_name' => 'nome do solicitante',
        'requester_email' => 'email do solicitante',
        'requester_phone_number' => 'número do solicitante',
        'patrimony_requester_taxpayer_id_number' => 'CPF do solicitante',
        'company_name' => 'razão social',
        'trading_name' => 'nome fantasia',
        'patrimony_supplier_national_tax_id_number' => 'CNPJ do fornecedor',
        'patrimony_asset' => 'bem',
        'toppled_number' => 'tombo',
        'patrimony_invoice_number' => 'número da nota fiscal',
        'invoice_emission_date' => 'data de emissão',
        'invoice_value' => 'valor da nota',
        'invoice_file' => 'arquivo',
        'statement_of_agreement' => 'número do empenho',
        'notice_of_settlement' => 'número da liquidação',
        'patrimony_supplier' => 'fornecedor',
        'term_number' => 'número do termo',
        'trade_number' => 'número do ofício',
        'patrimony_location' => 'local',
        'patrimony_requesters' => 'solicitantes',
        'patrimonies' => 'patrimônios',
        'movement_date' => 'data da movimentação',
        'patrimony_invoice' => 'nota fiscal',
        'reallocated_date' => 'data do remanejamento',
        'trade_file' => 'arquivo do ofício',
        'reallocated_date' => 'data do remanejamento',
        'patrimony_location_destiny' => 'local',
        'patrimony_requester' => 'solicitante',


        /**Credores*/
        'creditor_name' => 'nome do credor',
        'creditor_responsible' => 'credor resposável',
        'creditor_email' => 'email do credor',
        'creditor_phone' => 'telefone do credor',
        'creditor_phone' => 'telefone do credor',

        /** Contratos */
        'get_contract_type_id' => 'tipo de contrato',
        'get_contract_category_id' => 'modalidade de contrato',
        'get_city_hall_organization_id' => 'destino',
        'category_number' => 'número da modalidade',
        'contract_object' => 'objeto',
        'contract_number' => 'número do contrato',
        'contract_begin' => 'início do contrato',
        'contract_amount' => 'valor do contrato',
        'contract_observation' => 'observação',
        'get_provider_id' => 'prestador(es)',
        'get_contract_id' => 'contrato(s)',

        /** Aditivos */
        'contract_additive_type' => 'tipo de aditivo',
        'get_contract_id' => 'contrato',
        'contract_additive_deadline' => 'prazo',
        'contract_additive_amount' => 'valor',
        'contract_additive_observation' => 'observação',


        /** Prestadores da Saúde*/
        'taxpayer_id_number_patient' => 'CPF do Paciente',

        /** Usuário Profissional de Saúde */
        'healthcare_professional_user' => 'Usuário Profissional de Saúde',
        'health_establishment_trading_name' => 'Nome do Estabelecimento',
        'health_establishment_own_cnpj' => 'CNPJ do Estabelecimento',
        'health_establishment_cnes' => 'CNES do Estabelecimento',
        'health_establishment_zip_code' => 'CEP do Estabelecimento',
        'health_establishment_address' => 'Endereço do Estabelecimento',
        'health_establishment_number' => 'Número do Estabelecimento',
        'health_establishment_neighborhood' => 'Bairro do Estabelecimento',
        'health_establishment_city' => 'Cidade do Estabelecimento',
        'health_establishment_state' => 'UF do Estabelecimento',
        'services' => 'Serviços',
        'team' => 'Equipe',
        'service_provider_name' => 'Nome do Prestador de Serviços',
        'service_provider_cpf' => 'CPF do Prestador de Serviços',
        'service_provider_cbo_description' => 'CBO do Prestador de Serviços',
        'service_provider_cns' => 'CNS do Prestador de Serviços',
        'service_classification' => 'Classificação do Serviço',
        'service_procedure' => 'Processo do Serviço',
        'service_table_value' => 'Valor do Serviço',
        'service_description' => 'Descrição do Serviço',
        'user_type' => 'Tipo de Usuário',
        'health_establishment' => 'Estabelecimento de Saúde',
        'vacancy_start' => 'Início dos atendimentos',
        'vacancy_finish' => 'Término dos atendimentos',
        'vacancy_dates' => 'Datas das vagas',
        'vacancy_duration' => 'Tempo de atendimento',
        'service_providers' => 'Prestadores de Serviços',
        'vacancy_date' => 'Data da vaga',
        'regulator_comment' => 'Observação do Regulador',

        /** Serviço */
        'edit_modal_service_select' => 'serviço',
        'edit_modal_service_value' => 'valor',
        'service_value' => 'valor',
        'service' => 'serviço',

        /** Paciente Avulso */
        'patient_name' => 'nome do paciente',
        'patient_cpf' => 'CPF do paciente',
        'patient_cns' => 'CNS do paciente',
        'patient_birth' => 'data de nascimento',
        'patient_sex' => 'sexo',
        'patient_phone' => 'telefone',
        'patient_mother' => 'mãe',
        'patient_father' => 'pai',
        'patient_address' => 'endereço',
        'patient_neighborhood' => 'bairro',
        'patient_zip_code' => 'CEP',
        'patient_ibge' => 'código do IBGE',
        'patient_race_color' => 'raça ou cor',
        'patient_ethnicity' => 'etnia',
        'patient_country_cadsus' => 'nacionalidade',
        'patient_address_number' => 'número do endereço',
        'patient_address_complement' => 'complemento',
        'patient_address_dne' => 'DNE',
        'patient_email' => 'e-mail',
        'patient_cellphone' => 'telefone celular',
        'patient_contact_phone' => 'telefone de contato',
        'loose_request_file' => 'anexo',

        'g-recaptcha-response' => 'ReCaptcha',

        /** Convênios */
        'get_agreement_id' => 'convênio',

        /** Regulador */
        'add_service_select' => 'serviço',

        'reportRequest' => 'laudo',
        'service_provider' => 'prestador de serviço',
        'get_service_request_ticket_id' => 'atendimento',
        'get_vacancy_id' => 'vaga',
        'quantity_services' => 'quantidade de serviços',
        'healthEstablishmentByServices' => 'estabelecimento de saúde',
        'dateVacancieDemand' => 'data',
    ],

];
