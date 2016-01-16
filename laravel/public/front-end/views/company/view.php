<div class="{{css_class.save}}" ng-controller="CompanyController" ng-init="findOne()">
    <div ng-if="blockPage.status==200">
        <table class="{{ css_class.table }}">
            <tr>
                <th class="text-right">
                    Vinculo
                </th>
                <td>
                    <span data-ng-bind="company.start_date | date:'dd/MM/yyyy'"></span>
                    à {{ (company.end_date | date:'dd/MM/yyyy') || 'não informado'}}
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Nome
                </th>
                <td>
                    <div data-ng-bind="company.name"></div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    CNPJ
                </th>
                <td>
                    <div data-ng-bind="company.cnpj | registry"></div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    E-mail
                </th>
                <td>
                    <div data-ng-bind="company.email"></div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Telefone
                </th>
                <td>
                    <div data-ng-bind="company.phone | phone"></div>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Endereço
                </th>
                <td>
                    <span data-ng-bind="company.address"></span>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Status:
                </th>
                <td>
                    <generic-field module="{type:'status', resource:company, text:statusText}"></generic-field>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Alterações
                </th>
                <td>
                    <generic-field module="{type:'changes', resource:company}"></generic-field>
                </td>
            </tr>
        </table>
        <div class="clear"><br></div>
        <my-actions module="module"></my-actions>
    </div>
</div>