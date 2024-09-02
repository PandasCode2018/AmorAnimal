<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial del Animal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .section {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
        }

        p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <!-- Información del Animal -->
    @if (!is_null($informacionAnimal))
        @foreach ($informacionAnimal as $animal)
            <div class="section">
                <h2>Información del Animal</h2>
                <p><label>Nombre:</label> {{ $animal->name }}</p>
                <p><label>Especie:</label> {{ $animal->animalSpecies->name }}</p>
                <p><label>Raza:</label> {{ $animal->animal_race }}</p>
                <p><label>Edad:</label> {{ $animal->age }}</p>
                <p><label>Color:</label> {{ $animal->color }}</p>
                <p><label>Peso:</label> {{ $animal->weight }}</p>
                <p><label>Sexo:</label> {{ $animal->sex }}</p>
            </div>
        @endforeach
    @endif

    <!-- Información del Responsable -->
    @if ($infomacionResponsable)
        @foreach ($infomacionResponsable as $responsable)
            <div class="section">
                <h2>Información del Responsable</h2>
                <p><label>Nombre:</label> {{ $responsable->name }}</p>
                <p><label>Documento:</label> {{ $responsable->document_number }}</p>
                <p><label>Teléfono:</label> {{ $responsable->phone }}</p>
                <p><label>Correo:</label> {{ $responsable->email }}</p>
                <p><label>Dirección:</label> {{ $responsable->address }}</p>
            </div>
        @endforeach
    @endif

    <!-- Consultas Médicas -->
    @if ($informacionConsultas)
        <div class="section">
            <h2>Consultas Médicas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Doctor</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($informacionConsultas as $consulta)
                        <tr>
                            <td>{{ $consulta->date_time_query }}</td>
                            <td>{{ $consulta->doctor->name }}</td>
                            <td>{{ $consulta->reason }}</td>
                            <td>{{ $consulta->queryStatus->name_status }}</td>
                        </tr>

                        <!-- Notas de Ingreso -->
                        <tr>
                            <td colspan="4">
                                <p><label>Notas de ingreso:</label> {{ $consulta->note }}</p>
                            </td>
                        </tr>

                        <!-- Tratamientos -->
                        @foreach ($consulta->treatments as $tratamiento)
                            <tr>
                                <td colspan="4">
                                    <p><label>Nombre del Medicamento:</label> {{ $tratamiento->drug_name }}</p>
                                    <p><label>Presentación:</label> {{ $tratamiento->medicine_presentation }}</p>
                                    <p><label>Fecha de Aplicación:</label> {{ $tratamiento->application_date }}</p>
                                    <p><label>Fecha de Refuerzo:</label> {{ $tratamiento->reinforcement_date }}</p>
                                    <p><label>Dosis:</label> {{ $tratamiento->dose }}</p>
                                    <p><label>Frecuencia:</label> {{ $tratamiento->frequency }}</p>
                                    <p><label>Interno o Externo:</label>
                                        {{ $tratamiento->internal_or_external == 1 ? 'Interno' : 'Externo' }}</p>
                                    <p><label>Duración del Tratamiento:</label> {{ $tratamiento->treatment_duration }}
                                    </p>
                                    <p><label>Notas del tratamiento:</label> {{ $tratamiento->note }}</p>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</body>

</html>
