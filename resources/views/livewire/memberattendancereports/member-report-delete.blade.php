<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Members Attendance Report</title>
</head>
<style>
        @page {
            header: page-header;
            footer: page-footer;
        }
        * {
            box-sizing: border-box;
        }


        h2{
         padding: 2px;
         font-size: 18px;
       }

       h3{
         padding: 2px;
         font-size: 16px;
       }
       p{
         padding: 1px;
       }
      .styled-table {
          border-collapse: collapse;
          margin: 25px 0;
          font-size: 0.7em;
          font-family: sans-serif;
          width: 100%;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }
      .styled-table-st {
          border-collapse: collapse;
          margin: 25px 0;
          font-size: 0.7em;
          font-family: sans-serif;
          width: 30%;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      }
      .styled-table-st th,
      .styled-table-st td {
          padding: 5px;
          text-align: left;
      }

      .styled-table thead tr {
          background-color: #009879;
          color: #ffffff;
      }

      .styled-table th,
      .styled-table td {
          padding: 12px 15px;
          text-align: left;
      }

      .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .row:after {
          content: "";
          display: table;
          clear: both;
        }
       
        .divider {
            border-bottom: 2px solid #009879;
        }
        .column {
        float: left;
      }

      .left,.right {
        width: 18%;
      }

      .middle {
        width: 58%;
        text-align: center;
      }

      .row:after {
        content: "";
        display: table;
        clear: both;
      }

      .logo{
            height: 100px;
            width: auto;
            float: right;
          }
       .tname{
            padding-top: 20px;
          }   

      .jhomolhari{
        font-family: 'dzongkha', sans-serif;
      }

        .times{
        font-family: 'times', sans-serif;
      }
        
      .header{
        padding-top: 20px;
      } 

      .content{
        padding: 20px 20px; 
        margin-top:10px;
        text-align: justify;
      }

      .main{
        padding: 65px 20px; 
        text-align: justify;
      }

      .font-xl{
          font-size: 30px;
      }

      .font-lg{
          font-size: 26px;
      }

      .font-md{
          font-size: 20px;
      }

      .font-base{
          font-size: 18px;
      }

      .font-content{
          font-size: 16px;
      }

      .general-spacing{
        padding-top: 20px;
      }

      .footer{
         font-size: 12px;
          padding: 10px 10px 40px 10px;
          text-align: center;
      } 
    </style>
<body>
  <htmlpageheader name="page-header">
    <div class="header">
      <div class="row">
        <div class="column left">
           <div class="logo">
            <img src="{{public_path().'/assets/img/mp-logo.png'}}" class="logo">
          </div>
        </div>
        <div class="column middle">
          <div class="jhomolhari font-xl">འབྲུག་གི་སྤྱི་ཚོག།</div>
          <div class="times font-md">PARLIAMENT OF BHUTAN</div>
        </div>
        <div class="column right">
           <div class="logo">
            <img src="{{public_path().'/assets/img/logo.jpeg'}}" class="rgob logo">
          </div>
        </div>
      </div>
     </div>  
</htmlpageheader>
<main class="main">
  <div class="row content">
    <div class="column date"><?=$title?> </div>
  <div>
    
  <div>
    @php
      use App\Models\Attendance;
    @endphp
  <div class="mx-auto mt-2">
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="w-full overflow-x-auto">
      <table class="styled-table">
            <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50">
                <th>SL#</th>
                <th class="px-3 py-3">Name</th>
                <th class="px-3 py-3">CID</th>
                <th class="px-3 py-3">Member</th>
                <th class="px-3 py-3">Consitituncy</th>
                <th class="px-3 py-3">Contact#</th>
                <th class="px-3 py-3">Date</th>
                <th class="px-3 py-3">Attendance Time</th>
            </tr>
            </thead>  
            @foreach($attendancereports as $index=>$item)
            <tr class="text-gray-500">
              <td class="px-4 py-3">
                  <div class="flex items-center text-sm">
                      {{ $index+1 }}
                  </div>
                </td>

              @php
                $fromDate = Date('Y-m-d');
                $result = Attendance::with('user')->where('author', $item->id)->where('created_at', 'like', $fromDate . '%')->get();
              @endphp

              @if(count($result) > 0)
                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                      {{ $result[0]->user->name }}
                  </div>
                </td>

                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                      {{ $consitituncy = App\Http\Livewire\Utilities::getMemberConsitituncy($result[0]->author) }} 
                  </div>
                </td>


                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                      <?=date('d M Y', $result[0]['checkIn']); ?>
                  </div>
                </td>

                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                    @if(empty($result[0]['checkIn']))
                        <span class="bg-orange-500 shadow rounded py-1 px-3 text-gray-100 mx-1">
                        &nbsp;&nbsp;&nbsp;
                      </span>
                    @else
                      @if($result[0]['inStatus'] == 'Late')
                        <span class="bg-orange-500 shadow rounded py-1 px-3 text-gray-100 mx-1">
                          <?=date('h:i:s A', $result[0]['checkIn']); ?>
                      </span>
                      @else
                        <span class="bg-green-500 shadow rounded py-1 px-3 text-gray-100 mx-1">
                          <?=date('h:i:s A', $result[0]['checkIn']); ?>
                        </span>
                      @endif
                    @endif
                  </div>
                </td>
              
                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                    @if(!empty($item->userstatus->name))
                      <span class="bg-cyan-500 rounded py-1 px-2 text-cyan-100 mx-1">
                      {{  $item->userstatus->name  }}
                      </span>
                    @endif
                </td>

                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                      
                    @if(empty($result[0]['checkOut']))
                    Haven't Checked Out
                    @else
                      @if($result[0]['outStatus'] == 'Early')
                          <span class="bg-orange-500 shadow rounded py-1 px-3 text-gray-100 mx-1">
                          {{ date('h:i:s A', $result[0]->checkOut) }}
                          </span>
                        @else
                          <span class="bg-green-500 shadow rounded py-1 px-3 text-gray-100 mx-1">
                              {{ date('h:i:s A', $result[0]->checkOut) }}
                          </span>
                        @endif
                    
                    @endif
                  </div>
                </td>

                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                    {{ $result[0]->inNotes }}
                  </div>
                </td>

                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                    {{ $result[0]->outNotes }}
                  </div>
                </td>
          @else
                @php 
                  $fromDate = Date('Y-m-d');
                @endphp
                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                      {{ $item->name }}
                  </div>
                </td>

                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                      {{ $consitituncy = App\Http\Livewire\Utilities::getMemberConsitituncy($item->id) }} 
                  </div>
                </td>

                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                      {{ Carbon\Carbon::parse($fromDate)->format('d M Y') }}
                  </div>
                </td>
                
                <td class="px-2 py-3">
                  <div class="flex items-center text-sm">
                    <span class="bg-cyan-500 rounded py-1 px-2 text-gray-100 mx-1">
                        NA
                    </span>
                  </div>
                </td>

                <td class="px-2 py-3">
                </td>
          @endif

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>