<div>
    <table style="width: 100%; margin-bottom: 0">
        <tr>
            <td style="width: 65%">
                <img src="{{asset('/img/logo.png')}}" style="width: 200px">
            </td>
            <td style="width: 35%">
                <div>ARKADIA ONLUS APS</div>
                <div>via G. La Pira, 24</div>
                <div>Terranuova Bracciolini 52028</div>
                <div>C. F. 90025750515</div>
            </td>
        </tr>
    </table>

    <hr style="width: 100%; border: 2px solid red; margin-top: 0">

    <table style="width: 100%; margin-top: 30px">
        <tr>
            <td style="width: 25%; text-align: left">
                <span style="color: gray; font-size: 14px">RICEVUTA NR.</span>  <br>
                <span style="color: red"> <b>{{$ricevuta->progressivo}} / {{$ricevuta->anno}}</b> </span>
            </td>
            <td style="width: 30%; text-align: left">
                <span style="color: gray; font-size: 14px">DATA</span>  <br>
                <span style="color: red"> <b>{{\Illuminate\Support\Carbon::make($ricevuta->dataRicevuta)->format('d-m-Y')}}</b> </span>
            </td>
            <td style="width: 45%; text-align: left">
                <span style="color: gray; font-size: 14px">INTESTATARIO RICEVUTA</span> <br>
                {{$ricevuta->destinatario}} <br>
                {{$ricevuta->indirizzo}} <br>
                {{$ricevuta->cap}} {{$ricevuta->citta}} <br>
                {{$ricevuta->pivaCodfisc}}
            </td>
        </tr>
        <tr>
            <td style="width: 25%; text-align: left; font-size: 12px; padding-top: 30px">
                <span style="color: gray">MODALITA' PAGAMENTO</span>  <br>
                {{$ricevuta->modalitaPagamento}}
            </td>
            <td style="padding-top: 30px">&nbsp;</td>
            <td style="padding-top: 30px">&nbsp;</td>
        </tr>
    </table>

    <hr style="width: 100%; border: 2px solid red">

    <table style="width: 100%; height: 300px; margin-top: 50px">
        <tr style="border-bottom: 1px solid darkgray; border-top: 1px solid darkgray; padding: 10px 0">
            <th style="padding: 10px 0; border-right: 1px solid darkgray;">Descrizione</th>
            <th style="padding: 10px 0; text-align: center">Totale</th>
        </tr>
        <tr style="border-bottom: 1px solid darkgray; padding: 10px 0">
            <td style="padding: 10px 0; border-right: 1px solid darkgray;">{{$ricevuta->descrizione}}</td>
            <td style="padding: 10px 0; text-align: center">
                {{'€ '.number_format( (float) $ricevuta->importo, '2', ',', '.')}}
            </td>
        </tr>
        <tr style="border-bottom: 1px solid darkgray; padding: 10px 0">
            <td style="padding: 10px 0; border-right: 1px solid darkgray;">&nbsp;</td>
            <td style="padding: 10px 0">&nbsp;</td>
        </tr>
        <tr style="border-bottom: 1px solid darkgray; padding: 10px 0">
            <td style="padding: 10px 0; border-right: 1px solid darkgray;">&nbsp;</td>
            <td style="padding: 10px 0">&nbsp;</td>
        </tr>
    </table>

    <hr style="width: 100%; border: 1px solid black">

    <table style="width: 100%; font-size: 12px">
        <tr>
            <td>
                DATI BANCARI <br>
                BANCA DEL VALDARNO <br><br>
            </td>
            <td>
                <b>Totale imponibile</b>
            </td>
            <td>
                <b>{{'€ '.number_format( (float) $ricevuta->importo, '2', ',', '.')}}</b>
            </td>
        </tr>
        <tr>
            <td>
                CREDITO COOPERATIVO <br>
                FILIALE DI TERRANUOVA BRACCIOLINI (AR) <br>
                <b>IBAN</b>  <br>
                <b>IT70 X088 1171 6600 0000 0203 759</b>
            </td>
            <td colspan="2">
                Esente iva art.10 Comma 20 del DPR 633/1972. <br><br> Esente da imposta di bollo ai sensi dell’articolo 82 comma 5, del Decreto Legislativo 117/2017
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 40px">
        <tr>
            <td>

            </td>
            <td>
                <h2>Totale Ricevuta</h2>
            </td>
            <td>
                <h2>{{'€ '.number_format( (float) $ricevuta->importo, '2', ',', '.')}}</h2>
            </td>
        </tr>
    </table>
</div>
