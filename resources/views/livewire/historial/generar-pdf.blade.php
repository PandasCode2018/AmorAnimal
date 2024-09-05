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



                        <tr>
                            <td colspan="4" class="px-6 py-4 bg-gray-50">
                                <h3 class="text-xl font-semibold mb-4">Triage</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="font-semibold">Condición Corporal:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->condicion_corporal ?? null }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Temperatura Corporal:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->temperatura_corporal ?? null }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Frecuencia Respiratoria:</label>
                                        <p class="text-gray-700">
                                            {{ $consulta->triage->frecuencia_respiratoria ?? null }} °C</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Relleno Capilar:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->relleno_capilar ?? null }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Mucosa:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->mucosa ?? null }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Frecuencia Cardiaca:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->frecuencia_cardiaca ?? null }} Lpm
                                        </p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Pulso:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->pulso ?? null }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Número de Partos:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->numero_pardos ?? null }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Esterilizado:</label>
                                        <p class="text-gray-700">
                                            {{ $consulta->triage->esterilizado ?? null ? 'Sí' : 'No' }}</p>
                                    </div>
                                </div>
                                <br>
                                <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                                    <div>
                                        <label class="font-semibold">Última Desparacitación:</label>
                                        <p class="text-gray-700">
                                            {{ $consulta->triage->ultima_desparacitacion ?? null }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Cirugías Previas:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->cirugias_previas ?? null }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Esquema Vacunal:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->esquema_vacunal ?? null }}</p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Tratamiento Reciente:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->tratamiento_reciente ?? null }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Enfermedades Previas:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->enfermedades_previas ?? null }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="font-semibold">Dieta:</label>
                                        <p class="text-gray-700">{{ $consulta->triage->dieta ?? null }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</body>

</html>
