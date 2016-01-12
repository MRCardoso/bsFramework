<?php

    $rs = [
        // ---------------------A-------------------------------------------------------------
        "about_request"         => "sobre o pedido",
        "Actions"               => "ações",
        "active"                => "ativo",
        "info_additionals"      => "informações adicionais",
        "address"               => "endereço",
        "Already_exists_a_request_of_change_password_for_this_email_{email}." => "Já existe uma solicitação de alteração de senha para este e-mail {email}.",
        // ---------------------B-------------------------------------------------------------
        "back"                  => "voltar",
        "birthday"              => "aniversário",
         // ---------------------C-------------------------------------------------------------
        "cellphone"             => "celular",
        "change"                => "troco",
        "changed"               => "alterado",
        "changes"               => "alterações",
        "city"                  => "Cidade",
        "click_here_to_reset_your_password" => "clique aqui para recuperar sua senha",
        "client"                => "cliente",
        "client_id"             => "código do cliente",
        "code"                  => "código",
        "comission"             => "comissão",
        "comission_type"        => "Tipo de comissão",
        "comission_value"       => "valor da comissão",
        "company"               => "empresa",
        "company_id"            => "código da empresa",
        "corporate_register"    => "Corporação",
        "corporation"           => "Corporação",
        "cost"                  => "custo",
        "create"                => "criado",
        'created_at'            => "Criação",
        // ---------------------D-------------------------------------------------------------
        "delete"                => "remover",
        "deliveryman"           => "entregador",
        "deliveryman_id"        => "código do entregador",
        "description"           => "descrição",
        "discount"              => "desconto",
        "do_you_need_inform_a_product!" => "você precisa informar um produto!",
        // ---------------------E-------------------------------------------------------------
        "email"                 => "e-mail",
        "employee"              => "Funcionário",
        "employees"              => "Funcionários",
        "end_date"              => "Data final",
        // ---------------------F-------------------------------------------------------------
        "fill_in_your_e-mail_registered" => "preencha seu E-mail cadastrado",
        "forbidden"             => "Não autorizado",
        "forgot_my_password"    => "esqueci minha senha",
        "freight"               => "frete",
        // ---------------------G-------------------------------------------------------------
        "get_out"               => "sair",
        "group"                 => "grupo",
        // ---------------------H-------------------------------------------------------------
        "home"                  => "home",
        // ---------------------I-------------------------------------------------------------
        "I_could_not_find_any_user_with_the_email_address_specified." => "Não conseguimos encontrar nenhum usuário com o endereço de e-mail especificado.",
        "Inactive"              => "Inativo",
        "{param}_incorrect_for_access." => "{param} incorreto para acesso.",
        // ---------------------L-------------------------------------------------------------
        "link"                  => "vinculo",
        // ---------------------M-------------------------------------------------------------
        "more_recent_request_in_{date}" => "pedidos mais recentes em {date}",
        "my_data"               => "meus dados",
        // ---------------------N-------------------------------------------------------------
        "name"                  => "Nome",
        "neightborhood"         => "bairro",
        "new"                   => "novo",
        "no_informed"           => "não informado",
        "number"                => "número",
        // ---------------------O-------------------------------------------------------------
        "observation"           => "observação",
        // ---------------------P-------------------------------------------------------------
        "pass_1"                => "passo 1",
        "pass_2"                => "passo 2",
        "password"              => "senha",
        "password_confirmation" => "confirmação de senha",
        "phone"                 => "telefone",
        "price"                 => "preço",
        "product"               => "produto",
        "products"              => "produtos",
        "product_id"            => "código do produto",
        "this_product_is_bound_to_{request},_and_can_not_be_removed!" => "este produto está ligado a {request} pedido(s), e não pode ser removido!",
        // ---------------------Q-------------------------------------------------------------
        "quantity"              => "quantidade",
        // ---------------------R-------------------------------------------------------------
        "recover_the_password"  => "recuperar a senha",
        "Redefine_password"     => "redefinir senha",
        "reference"             => "referencia",
        "remember token"        => "salvar token",
        "removed"               => "removido",
        "request"               => "pedido",
        "request_date"          => "data do pedido",
        "reset_password"        => "recuperar senha",
        // ---------------------S-------------------------------------------------------------
        "save"                  => "salvar",
        "see_more..."           => "veja mais...",
        "send_token"            => "enviar token",
        "select"                => "selecione",
        "situation"             => "situação",
        "size"                  => "tamanho",
        "start_date"            => "Data inicial",
        "status"                => "Status",
        // ---------------------T-------------------------------------------------------------
        "the_{attribute}_can_not_be_greater_than_{length}" => "o \"{attribute}\" não pode ser maior que {length}",
        "the_record_not_was_{action}" => "o registro não foi {action}",
        "the_record_was_{action}_with_successful" => "o registro foi {action} com sucesso",
        "the_requested_page_does_not_exist." => "a página requisitada não existe.",
        "the_user_don't_has_permission_to_access_this_interface" => "O Usuário Não Tem Permissão Para Acessar Esta Interface",
        "this_User_was_deactivated." => "este usuário foi desativado.",
        "total_value"           => "valor total",
        // ---------------------U-------------------------------------------------------------
        "uninformed"             => "não informado",
        "update"                => "Atualizar",
        "updated_at"            => "Atualizado",
        "user"                  => "usuario",
        "username"              => "usuário",
        // ---------------------V-------------------------------------------------------------
        "values"                => "valores",
        "view"                  => "visualizar",
        // ---------------------X-------------------------------------------------------------
        // ---------------------Y-------------------------------------------------------------
        "you_sure_you_want_to_delete_this_record" => "Tem certeza de que deseja excluir este registro",
        // ---------------------W-------------------------------------------------------------
        // ---------------------Z-------------------------------------------------------------
    ];
    foreach($rs as $k => $row)
        $rs[strtolower($k)] = ucwords($row);

    return $rs;