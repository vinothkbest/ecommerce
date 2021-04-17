@php
$count=$data->count();
$per_page=$data->perPage();
$current_page=$data->currentPage();
$from=request()->rows*($current_page-1)+1;
$to=request()->rows*($current_page-1)+$count;

@endphp
<div class="d-flex align-items-end flex-column">
    <div class="p-2 mr-1 mb-3" style="margin:10px 50px;">
        {{ $slot }}
    </div>
</div>
<div class="block-content block-content-full">

    <div class="row" style=" margin-bottom:10px">
        <div class="col-sm-6">
            <div class="form-inline">
                <div class="form-group">
                    Show &nbsp;
                    <select id="per-page" class="field form-control" name="per_page">
                        <!-- <option value="5" {{request()->rows==5?'selected':''}}>5</option> -->
                        <option value="10" @selector(request()->rows,10)>10</option>
                        <option value="25" @selector(request()->rows,25)>25</option>
                        <option value="50" @selector(request()->rows,50)>50</option>
                        <option value="100" @selector(request()->rows,100)>100</option>

                    </select>
                    &nbsp;&nbsp;entries
                </div>
            </div>

        </div>
        <div class="col-sm-6 text-right">
            <div style="float:right">
                <div class="form-inline">
                    <div class="form-group">
                        <label for="">Search&nbsp;&nbsp;</label>
                        <input type="text" id="search-string" class="form-control" value="{{request()->search}}">
                        {{-- <button type="button" class="btn btn-primary" id="search"><i class="ti-search"></i></button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    <th style="width: 10%">S.No</th>

                    @foreach ($columns as $column)
                    <th>{{$column}}</th>
                    @endforeach


                </tr>
            </thead>
            <tbody>
                @php ($i = $from)

                @forelse ($data->map(function($item){ return $item->dynamicTableData();}) as $row)
                <tr>

                    <td>{{ $i }}</td>
                    @foreach($row as $item)
                    @if(is_array($item))
                    @if($item[0]=='html')
                    <td> {!! $item[1] !!}</td>
                    @endif
                    @else
                    <td>{{$item}}</td>
                    @endif
                    @endforeach


                </tr>
                @php ($i++)
                @empty
                <tr>
                    <td colspan="{{count($columns)+1}}" style="text-align: center">No data found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-sm-6">


            Showing {{$from}} to {{$to}} of {{$data->total()}} entries
        </div>
        <div class="col-sm-6 ">
            <div style="float:right">
                <?php
                $append=request()->all();
            ?>
                {{ $data->appends($append)->OnEachSide(2)->links() }}
            </div>

        </div>
    </div>


    @push('scripts')
    <script>
        jQuery(function () {
            jQuery('#per-page').change(function () {
               // alert('hi');
                var per_page = jQuery(this).val();
                jQuery('input[name=rows]').val(per_page);
                jQuery('#filter').submit();
            });

            jQuery('#search-string').keyup(function () {

                delay(function () {
                    //loading.show();
                    var search_string = jQuery('#search-string').val();
                    jQuery('input[name=search]').val(search_string);
                    jQuery('#filter').submit();
                }, 1000);
            });


            var delay = (function () {
                var timer = 0;
                return function (callback, ms) {
                    clearTimeout(timer);
                    timer = setTimeout(callback, ms);
                };
            })();
        });

    </script>


    @endpush
