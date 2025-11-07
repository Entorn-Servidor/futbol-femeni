@props(['estadi'])

<tr>
    <td style="padding: 10px; text-align: center;">{{ $estadi['id'] }}</td>
    <td style="padding: 10px;">
        <strong>{{ $estadi['nom'] }}</strong>
    </td>
    <td style="padding: 10px;">{{ $estadi['ciutat'] }}</td>
    <td style="padding: 10px; text-align: right;">{{ number_format($estadi['capacitat'], 0, ',', '.') }}</td>
    <td style="padding: 10px;">{{ $estadi['equip_principal'] }}</td>
</tr>