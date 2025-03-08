<div>
    <table style="width: 100%; margin-bottom: 0">
        <tr>
            <td style="width: 65%">
                <img src="{{asset('img/logo.png')}}" style="width: 200px">
            </td>
            <td style="width: 35%">
                <div>ARKADIA ONLUS APS</div>
                <div>via G. La Pira, 24</div>
                <div>Terranuova Bracciolini 52028</div>
                <div>C. F. 90025750515</div>
            </td>
        </tr>
    </table>

    <hr style="width: 100%; border: 2px solid red">

    <table style="width: 100%; height: 300px; margin-top: 50px">
        <thead>
        <tr style="border-bottom: 1px solid darkgray; padding: 10px 0">
            <th scope="col" style="padding: 10px 0; border: 1px solid darkgray;">
                Prog.
            </th>
            <th scope="col" style="padding: 10px 0; border: 1px solid darkgray;">
                Destinatario
            </th>
            <th scope="col" style="padding: 10px 0; border: 1px solid darkgray;">
                Importo
            </th>
            <th scope="col" style="padding: 10px 0; border: 1px solid darkgray;">
                Data Ricevuta
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($listaRicevute as $ricevuta)
        <tr style="border-bottom: 1px solid darkgray; padding: 10px 0">
            <td style="padding: 10px 0; border: 1px solid darkgray; text-align: center">
                {{$ricevuta->progressivo}}
            </td>
            <td style="padding: 10px 0; border: 1px solid darkgray; text-align: center">
                {{$ricevuta->destinatario}}
            </td>
            <td style="padding: 10px 0; border: 1px solid darkgray; text-align: center">
                € {{$ricevuta->importo}}
            </td>
            <td style="padding: 10px 0; border: 1px solid darkgray; text-align: center">
                {{$ricevuta->dataformattata}}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>


</div>
