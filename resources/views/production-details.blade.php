@extends('layouts.app')
@section('content')


        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-lg mt-2">
                <div class="card-header small">
                    

                    <a href="{{route('production.panel')}}"><i class="fas fa-reply"></i> Produkcja</a>&nbsp;&nbsp;{{$date_start}} — {{$date_end}}
               
                  </div>
                <div class="card-body mt-2">


                    <table class="table table-sm table-striped table-bordered small" id="elementproduction">        

                        <thead class="">
                            <tr>
                                <th>Data</th>
                                <th>Materiał</th>
                                {{-- <th>Waga</th> --}}
                                <th>Ilość</th>
                                <th>Kod(E)</th>
                                <th>Nazwa</th>
                                <th>X(dł.)</th>
                                <th>Y(szer.)</th>
                                <th>Z(wys.)</th>
                                <th>Artykuł</th>
                                <th>Produkt</th>
                                <th>Zamówienie</th>
                                {{-- <th>Maszyna</th>
                                <th>Grupa</th> --}}
                            </tr>                                
                        </thead>
                    </table>

                    <script>
                        $(function() {
                           
                            






                            $('#elementproduction').DataTable({
                                processing: true,
                                serverSide: true,
                                pageLength: 25,
                                
                                
                                ajax : '{!! route('DataElementProduction', ['date_start'=>$date_start, 'date_end'=>$date_end]) !!}',
                            
                           
                                columns: [
                                    
                                   
                                    {data: 'date_production', name: 'date_production'}, 
                                    {data: 'material', name: 'material'}, 
                                    // {data: 'weight', name: 'weight'}, 

                                    {data: 'amount', name: 'amount'}, 
                                    {data: 'element.code', name: 'element.code' },
                                    {data: 'element.name', name: 'element.name'},

                                    {data: 'element.length', name: 'element.length'},
                                    {data: 'element.width', name: 'element.width'},
                                    {data: 'element.height', name: 'element.height'},                             
                                    
                                    {data: 'article_info', name: 'articel_info'},
                                    {data: 'product_info', name: 'product_info'},
                                    {data: 'order_info', name: 'order_info'},

                                    // {data: 'machine', name: 'machine'}, 
                                    // {data: 'job_group', name: 'job_group'},
                                ]
                            });
                        });
                        </script>

                </div>
                <div class="card-footer text-center py-3 small">
                    
                </div>
            </div>
        </div>

























@endsection
