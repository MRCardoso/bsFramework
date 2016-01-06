<div class="{{css_class.save}}" ng-controller="ClientController" ng-init="findOne()">
    <div ng-if="blockPage.status==200">
        <table class="{{ css_class.table }}">
            <tr>
                <th class="text-right">
                    Usuário
                </th>
                <td>
                    <div ng-bind="client.user.name"></div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Nome
                </th>
                <td>
                    <div ng-bind="client.name"></div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Telefone
                </th>
                <td>
                    <div ng-bind="client.phone | phone"></div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Nascimento
                </th>
                <td>
                    <div ng-bind="client.birthday | date:'dd/mm/yyyy'"></div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Endereço
                </th>
                <td>
                    {{client.address}}
                    <span ng-show="client.number!=null">Nº {{client.number}}</span>
                    <span ng-show="client.reference!=null">- {{ client.reference }}</span>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Bairro
                </th>
                <td>
                    <div ng-bind="client.neightborhood"></div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Cidade
                </th>
                <td>
                    <div ng-bind="client.city"></div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Status
                </th>
                <td>
                    <generic-field module="{type:'status', resource:client, text:statusText}"></generic-field>
                </td>
            </tr>
            <tr>
                <th class="text-right">Alterações</th>
                <td>
                    <generic-field module="{type:'changes', resource:client}"></generic-field>
                </td>
            </tr>
        </table>
        <div class="clear"><br></div>
        <my-actions module="module"></my-actions>
    </div>
</div>