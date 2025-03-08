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
                Giorno
            </th>
            <th scope="col" style="padding: 10px 0; border: 1px solid darkgray;">
                Km percorsi
            </th>
            <th scope="col" style="padding: 10px 0; border: 1px solid darkgray;">
                Operatore
            </th>
            <th scope="col" style="padding: 10px 0; border: 1px solid darkgray;">
                Passeggeri
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($trips as $trip)
        <tr style="border-bottom: 1px solid darkgray; padding: 10px 0">
            <td style="padding: 10px 0; border: 1px solid darkgray; text-align: center">
                {{$trip->giornoformattato}}
            </td>
            <td style="padding: 10px 0; border: 1px solid darkgray; text-align: center">
                {{$trip->kmPercorsi}}
            </td>
            <td style="padding: 10px 0; border: 1px solid darkgray; text-align: center">
                {{$trip->user->name}}
            </td>
            <td style="padding: 10px 0; border: 1px solid darkgray; text-align: center">
                @foreach($trip->clients as $client)
                    {{$client->name}} <br>
                @endforeach
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <h3 class="text-white text-center text-3xl">Km Totali: {{$trips->sum('kmPercorsi')}}</h3>
    <h3 class="text-white text-center text-3xl mt-2">
        Costo totale: € {{ number_format($trips->sum('kmPercorsi') * 0.45, 2, ',', '.')   }}
    </h3>

</div>
