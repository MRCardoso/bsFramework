<div class="{{ css_class.save }}" ng-controller="DeliverymanController" ng-init="findOne()">
    <div ng-if="blockPage.status==200">
        <table class="{{ css_class.table }}">
            <tr>
                <th class="text-right">Usuário</th>
                <td>{{ deliveryman.user.name }}</td>
            </tr>
            <tr>
                <th class="text-right">Empresa</th>
                <td>{{ deliveryman.company.name }} - ({{ deliveryman.company.cnpj | registry}})</td>
            </tr>
            <tr>
                <th class="text-right">Name</th>
                <td>{{ deliveryman.name }}</td>
            </tr>
            <tr>
                <th class="text-right">CPF</th>
                <td>{{ deliveryman.cpf | registry }}</td>
            </tr>
            <tr>
                <th class="text-right">RG</th>
                <td>{{ deliveryman.rg }}</td>
            </tr>
            <tr>
                <th class="text-right">Celular</th>
                <td>{{ deliveryman.cellphone }}</td>
            </tr>
            <tr>
                <th class="text-right">Comissão</th>
                <td>
                    {{ deliveryman.salary_value }} - {{ salaryType[deliveryman.salary_type].name }}
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Status
                </th>
                <td>
                    <generic-field module="{type:'status', resource:deliveryman,text:statusText}"></generic-field>
                </td>
            </tr>
            <tr>
                <th class="text-right">
                    Alterações
                </th>
                <td>
                    <generic-field module="{type:'changes', resource:deliveryman}"></generic-field>
                </td>
            </tr>

        </table>
        <div class="clear"><br></div>
        <my-actions module="module"></my-actions>
    </div>
</div>