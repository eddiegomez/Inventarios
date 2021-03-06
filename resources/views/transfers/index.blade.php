@extends('layouts.app', ['page' => 'Transferências', 'pageSlug' => 'transfers', 'section' => 'transactions'])

@section('content')
    @include('alerts.success')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Transferências</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('transfer.create') }}" class="btn btn-sm btn-primary">
                                Registar Transferência
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class=" text-primary">
                            <th>Data</th>
                            <th>Título</th>
                            <th>Método de envio</th>
                            <th>Método de recepção</th>
                            <th>Referência</th>
                            <th>Montante enviado</th>
                            <th>Montante recebido</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($transfers as $transfer)
                                <tr>
                                    <td>{{ date('d-m-y', strtotime($transfer->created_at)) }}</td>
                                    <td style="max-width:150px">{{ $transfer->title }}</td>
                                    <td><a href="{{ route('methods.show', $transfer->sender_method) }}">{{ $transfer->sender_method->name }}</a></td>
                                    <td><a href="{{ route('methods.show', $transfer->receiver_method) }}">{{ $transfer->receiver_method->name }}</a></td>
                                    <td>{{ $transfer->reference }}</td>
                                    <td>${{ $transfer->sended_amount }}</td>
                                    <td>${{ $transfer->received_amount }}</td>
                                    <td class="td-actions text-right">
                                        <form action="{{ route('transfer.destroy', $transfer) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Delete Transfer" onclick="confirm('Tem certeza que pretende remover esta transferência?') ? this.parentElement.submit() : ''">
                                                <i class="tim-icons icon-simple-remove"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $transfers->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
