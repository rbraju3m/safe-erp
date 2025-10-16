{{--

<?php
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\DB;
?>
    <section class="">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <div class="box-body table-responsive no-padding">
              <table  id="example1" class="table table-bordered table-striped text-center">
                <thead>
                <tr>
                  <th>  </th>
                  <th> 2019 </th>
                  <th> 2020 </th>
                  <th> 2021 </th>
                  <th> 2022</th>
                  <th> 2023 </th>
                  <th> 2024 </th>
                  <th> 2025 </th>
                  <th> Total </th>
                </tr>
                </thead>
<tbody>
<tr>
  <td style="padding: 3px;"><b>Registration</b></td>
  <td style="padding: 3px;">
    <?php
      $total_2019 = 0;
      $Registration = 0;
    ?>
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if ($element->type == 'Registration')
            {{ $element->amount }}
            <?php
              $total_2019 = $total_2019+$element->amount;
              $Registration = $Registration+$element->amount;
            ?>
          @else
          @endif
        @endforeach
      @endif
  </td>
  <td style="padding: 3px;">
    <?php
      $total_2020 = 0;
    ?>
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if ($element->type == 'Registration')
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $Registration = $Registration+$element->amount;
              ?>
          @else
          @endif
        @endforeach
      @endif
  </td>
  <td style="padding: 3px;">
    <?php
      $total_2021 = 0;
    ?>
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if ($element->type == 'Registration')
            {{ $element->amount }}
            <?php
            $Registration = $Registration+$element->amount;
            $total_2021 = $total_2021+$element->amount;?>
          @else
          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
    <?php
      $total_2022 = 0;
    ?>
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if ($element->type == 'Registration')
            {{ $element->amount }}
            <?php
            $Registration = $Registration+$element->amount;
            $total_2022 = $total_2022+$element->amount;?>
          @else
          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
    <?php
      $total_2023 = 0;
    ?>
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if ($element->type == 'Registration')
            {{ $element->amount }}
            <?php
              $Registration = $Registration+$element->amount;
            $total_2023 = $total_2023+$element->amount;?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
    <?php
      $total_2024 = 0;
    ?>
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if ($element->type == 'Registration')
            {{ $element->amount }}
            <?php
              $Registration = $Registration+$element->amount;
            $total_2024 = $total_2024+$element->amount;?>
          @else
          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
    <?php
      $total_2025 = 0;
    ?>
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if ($element->type == 'Registration')
            {{ $element->amount }}
            <?php
              $Registration = $Registration+$element->amount;
            $total_2025 = $total_2025+$element->amount;?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">
    {{ $Registration }}
  </td>
</tr>
<tr>
  <td style="padding: 3px;"><b>January</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'January') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
      <?php
        $January_total = 0;
        $total_2019 = $total_2019+$element->amount;
        $January_total = $January_total+$element->amount;
      ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'January') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}

      <?php
        $total_2020 = $total_2020+$element->amount;
        $January_total = $January_total+$element->amount;
      ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'January') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
        <?php
          $total_2021 = $total_2021+$element->amount;
          $January_total = $January_total+$element->amount;
        ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'January') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
        <?php
          $total_2022 = $total_2022+$element->amount;
          $January_total = $January_total+$element->amount;
        ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'January' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
      <?php
        $total_2023 = $total_2023+$element->amount;
        $January_total = $January_total+$element->amount;
      ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'January' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
        <?php
          $total_2024 = $total_2024+$element->amount;
          $January_total = $January_total+$element->amount;
        ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'January') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
        <?php
          $total_2025 = $total_2025+$element->amount;
          $January_total = $January_total+$element->amount;
        ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $January_total }}</td>
</tr>
<tr>
  <td style="padding: 3px;"><b>February</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'February') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
    <?php
      $February_total = 0;
      $total_2019 = $total_2019+$element->amount;
      $February_total = $February_total+$element->amount;
    ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'February') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
        <?php
          $February_total = $February_total+$element->amount;
          $total_2020 = $total_2020+$element->amount;
        ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'February') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
        <?php
          $February_total = $February_total+$element->amount;
          $total_2021 = $total_2021+$element->amount;
        ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'February' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
        <?php
          $February_total = $February_total+$element->amount;
          $total_2022 = $total_2022+$element->amount;
        ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'February' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
        <?php
          $February_total = $February_total+$element->amount;
          $total_2023 = $total_2023+$element->amount;
        ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'February' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
        <?php
          $February_total = $February_total+$element->amount;
          $total_2024 = $total_2024+$element->amount;
        ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'February') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
      <?php
        $February_total = $February_total+$element->amount;
        $total_2025 = $total_2025+$element->amount;
      ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $February_total }}</td>
</tr>

<tr>
  <td style="padding: 3px;"><b>March</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'March' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $March_total = 0;
              $total_2019 = $total_2019+$element->amount;
              $March_total = $March_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'March' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $March_total = $March_total+$element->amount;
              $total_2020 = $total_2020+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'March' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $March_total = $March_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'March' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2022 = $total_2022+$element->amount;
              $March_total = $March_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'March' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $March_total = $March_total+$element->amount;

            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'March' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $March_total = $March_total+$element->amount;

            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'March' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2025 = $total_2025+$element->amount;
              $March_total = $March_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td  style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $March_total }}</td>
</tr>

<tr>
  <td style="padding: 3px;"><b>April</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'April' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $April_total = 0;
              $total_2019 = $total_2019+$element->amount;
              $April_total = $April_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'April' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $April_total = $April_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'April' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $April_total = $April_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'April' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2022 = $total_2022+$element->amount;
              $April_total = $April_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'April' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $April_total = $April_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'April' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $April_total = $April_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'April' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $April_total = $April_total+$element->amount;
              $total_2025 = $total_2025+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td  style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $April_total }}</td>
</tr>

<tr>
  <td style="padding: 3px;"><b>May</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'May' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $May_total = 0;
              $total_2019 = $total_2019+$element->amount;
              $May_total = $May_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'May' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $May_total = $May_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'May' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $May_total = $May_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'May' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2022 = $total_2022+$element->amount;
              $May_total = $May_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'May' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $May_total = $May_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'May' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $May_total = $May_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'May' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2025 = $total_2025+$element->amount;
              $May_total = $May_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td  style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $May_total }}</td>

</tr>

<tr>
  <td style="padding: 3px;"><b>June</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'June' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $June_total = 0;
              $total_2019 = $total_2019+$element->amount;
              $June_total = $June_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'June' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $June_total = $June_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'June' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $June_total = $June_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'June' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2022 = $total_2022+$element->amount;
              $June_total = $June_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'June' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $June_total = $June_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'June' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $June_total = $June_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'June' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2025 = $total_2025+$element->amount;
              $June_total = $June_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td  style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $June_total }}</td>
</tr>

<tr>
  <td style="padding: 3px;"><b>July</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'July' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $July_total = 0;
              $total_2019 = $total_2019+$element->amount;
              $July_total = $July_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'July' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $July_total = $July_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'July' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $July_total = $July_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'July' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2022 = $total_2022+$element->amount;
              $July_total = $July_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'July' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $July_total = $July_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'July' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $July_total = $July_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'July' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2025 = $total_2025+$element->amount;
              $July_total = $July_total+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td  style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $July_total }}</td>
</tr>

<tr>
  <td style="padding: 3px;"><b>August</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'August' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $August_total = 0;
              $total_2019 = $total_2019+$element->amount;
              $August_total = $August_total+$element->amount;?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'August') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $August_total = $August_total+$element->amount;?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'August' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $August_total = $August_total+$element->amount;?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'August' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2022 = $total_2022+$element->amount;
              $August_total = $August_total+$element->amount;?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'August') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $August_total = $August_total+$element->amount;?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'August' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $August_total = $August_total+$element->amount;?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'August') && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2025 = $total_2025+$element->amount;
              $August_total = $August_total+$element->amount;?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td  style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $August_total }}</td>
</tr>

<tr>
  <td style="padding: 3px;"><b>September</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'September' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $September = 0;
              $total_2019 = $total_2019+$element->amount;
              $September = $September+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'September' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $September = $September+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'September' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $September = $September+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'September' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
             $total_2022 = $total_2022+$element->amount;
              $September = $September+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'September' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $September = $September+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'September' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $September = $September+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'September' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2025 = $total_2025+$element->amount;
              $September = $September+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td  style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $September }}</td>
</tr>

<tr>
  <td style="padding: 3px;"><b>October</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'October' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $October = 0;
              $total_2019 = $total_2019+$element->amount;
              $October = $October+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'October' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $October = $October+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'October' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $October = $October+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'October' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2022 = $total_2022+$element->amount;
              $October = $October+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'October' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $October = $October+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'October' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $October = $October+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'October' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2025 = $total_2025+$element->amount;
              $October = $October+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td  style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $October }}</td>
</tr>

<tr>
  <td style="padding: 3px;"><b>November</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'November' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $November = 0;
              $total_2019 = $total_2019+$element->amount;
              $November = $November+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'November' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $November = $November+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'November' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $November = $November+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'November' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2022 = $total_2022+$element->amount;
              $November = $November+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'November' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $November = $November+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'November' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $November = $November+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'November' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2025 = $total_2025+$element->amount;
              $November = $November+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td  style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $November }}</td>
</tr>

<tr>
  <td style="padding: 3px;"><b>December</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if (($element->month == 'December' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $December = 0;
              $total_2019 = $total_2019+$element->amount;
              $December = $December+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if (($element->month == 'December' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $December = $December+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if (($element->month == 'December' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $December = $December+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if (($element->month == 'December' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2022 = $total_2022+$element->amount;
              $December = $December+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if (($element->month == 'December' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $December = $December+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if (($element->month == 'December' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $December = $December+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if (($element->month == 'December' ) && ($element->type == 'Monthly' || $element->type == 'Monthly With Due'))
            {{ $element->amount }}
            <?php
              $total_2025 = $total_2025+$element->amount;
              $December = $December+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $December }}</td>
</tr>

<tr>
  <td style="padding: 3px;"><b>Yearly</b></td>
  <td style="padding: 3px;">
      @if(isset($deposite2019))
        @foreach ($deposite2019 as $element)
          @if ($element->type == 'Yearly')
            {{ $element->amount }}
            <?php
              $Yearly = 0;
              $total_2019 = $total_2019+$element->amount;
              $Yearly = $Yearly+$element->amount;
            ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2020))
        @foreach ($deposite2020 as $element)
          @if ($element->type == 'Yearly')
            {{ $element->amount }}
            <?php
              $total_2020 = $total_2020+$element->amount;
              $Yearly = $Yearly+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2021))
        @foreach ($deposite2021 as $element)
          @if ($element->type == 'Yearly')
            {{ $element->amount }}
            <?php
              $total_2021 = $total_2021+$element->amount;
              $Yearly = $Yearly+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2022))
        @foreach ($deposite2022 as $element)
          @if ($element->type == 'Yearly')
            {{ $element->amount }}
            <?php
              $total_2022 = $total_2022+$element->amount;
              $Yearly = $Yearly+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2023))
        @foreach ($deposite2023 as $element)
          @if ($element->type == 'Yearly')
            {{ $element->amount }}
            <?php
              $total_2023 = $total_2023+$element->amount;
              $Yearly = $Yearly+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td style="padding: 3px;">
      @if(isset($deposite2024))
        @foreach ($deposite2024 as $element)
          @if ($element->type == 'Yearly')
            {{ $element->amount }}
            <?php
              $total_2024 = $total_2024+$element->amount;
              $Yearly = $Yearly+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>

  <td style="padding: 3px;">
      @if(isset($deposite2025))
        @foreach ($deposite2025 as $element)
          @if ($element->type == 'Yearly')
            {{ $element->amount }}
            <?php
              $total_2025 = $total_2025+$element->amount;
              $Yearly = $Yearly+$element->amount;
              ?>
          @else

          @endif
        @endforeach
      @endif
  </td>
  <td style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $Yearly }}</td>
</tr>
<tr>
  <td style="padding: 3px;"><b>Profit</b></td>
  <td style="padding: 3px;"><b></b></td>
  <td style="padding: 3px;"><b></b></td>
    @php
        $memberProfit2021 = DB::table('profit_distribute')
                ->join('profit_distribute_member','profit_distribute_member.profit_id','=','profit_distribute.id')
                ->where('profit_distribute.profit_year',2021)
                ->where('profit_distribute_member.member_id',$member->id)
                ->first();
        $profit2021 = $memberProfit2021 && $memberProfit2021->profit_amount ? $memberProfit2021->profit_amount : 0;
    @endphp
  <td style="padding: 3px;"><b>{{$profit2021>0?$profit2021:''}}</b></td>
    @php
        $memberProfit2022 = DB::table('profit_distribute')
                ->join('profit_distribute_member','profit_distribute_member.profit_id','=','profit_distribute.id')
                ->where('profit_distribute.profit_year',2022)
                ->where('profit_distribute_member.member_id',$member->id)
                ->first();
        $profit2022 = $memberProfit2022 && $memberProfit2022->profit_amount ? $memberProfit2022->profit_amount : 0;
    @endphp
    <td style="padding: 3px;"><b>{{$profit2022>0?$profit2022:''}}</b></td>
    @php
        $memberProfit2023 = DB::table('profit_distribute')
                ->join('profit_distribute_member','profit_distribute_member.profit_id','=','profit_distribute.id')
                ->where('profit_distribute.profit_year',2023)
                ->where('profit_distribute_member.member_id',$member->id)
                ->first();
        $profit2023 = $memberProfit2023 && $memberProfit2023->profit_amount ? $memberProfit2023->profit_amount : 0;
    @endphp
    <td style="padding: 3px;"><b>{{$profit2023>0?$profit2023:''}}</b></td>
    @php
        $memberProfit2024 = DB::table('profit_distribute')
                ->join('profit_distribute_member','profit_distribute_member.profit_id','=','profit_distribute.id')
                ->where('profit_distribute.profit_year',2024)
                ->where('profit_distribute_member.member_id',$member->id)
                ->first();
        $profit2024 = $memberProfit2024 && $memberProfit2024->profit_amount ? $memberProfit2024->profit_amount : 0;
    @endphp
    <td style="padding: 3px;"><b>{{$profit2024>0?$profit2024:''}}</b></td>
    @php
        $memberProfit2025 = DB::table('profit_distribute')
                ->join('profit_distribute_member','profit_distribute_member.profit_id','=','profit_distribute.id')
                ->where('profit_distribute.profit_year',2025)
                ->where('profit_distribute_member.member_id',$member->id)
                ->first();
        $profit2025 = $memberProfit2025 && $memberProfit2025->profit_amount ? $memberProfit2025->profit_amount : 0;
    @endphp
    <td style="padding: 3px;"><b>{{$profit2025>0?$profit2025:''}}</b></td>

    <td style="padding: 3px;background-color: #18666f;color: #fff;font-weight: bold;">{{ $profit2025+$profit2024+$profit2023+$profit2022+$profit2021 }}</td>
</tr>
<tr>
  <td><b>Total</b></td>
  <td style="background: #064073;color: #fff;"><b>{{ $total_2019 }}</b></td>
  <td style="background: #064073;color: #fff;"><b>{{ $total_2020 }}</b></td>
  <td style="background: #064073;color: #fff;"><b>{{ $total_2021+$profit2021 }}</b></td>
  <td style="background: #064073;color: #fff;"><b>{{ $total_2022+$profit2022 }}</b></td>
  <td style="background: #064073;color: #fff;"><b>{{ $total_2023+$profit2023 }}</b></td>
  <td style="background: #064073;color: #fff;"><b>{{ $total_2024+$profit2024 }}</b></td>
  <td style="background: #064073;color: #fff;"><b>{{ $total_2025+$profit2025 }}</b></td>
  <td style="background: #064073;color: #fff;"><b>{{ $total_2025+$total_2019+$total_2024+$total_2023+$total_2022+$total_2021+$total_2020+$profit2025+$profit2024+$profit2023+$profit2022+$profit2021 }}</b></td>
</tr>
</tbody>
              </table>
            </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>





--}}


<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    @foreach($years as $year)
                                        <th>{{ $year }}</th>
                                    @endforeach
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{-- Registration Fees --}}
                                <tr>
                                    <td><b>Registration</b></td>
                                    @php $registration_total = 0; @endphp
                                    @foreach($years as $year)
                                        <td>
                                            @php $year_total = 0; @endphp
                                            @foreach($deposits[$year] as $d)
                                                @if($d->type == 'Registration')
                                                    {{ $d->amount }}<br>
                                                    @php $registration_total += $d->amount; $year_total += $d->amount; @endphp
                                                @endif
                                            @endforeach
                                        </td>
                                    @endforeach
                                    <td style="background-color:#18666f;color:white;font-weight:bold">{{ $registration_total }}</td>
                                </tr>

                                {{-- Monthly (January to December) --}}
                                @php
                                    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                @endphp
                                @foreach($months as $month)
                                    <tr>
                                        <td><b>{{ $month }}</b></td>
                                        @php $month_total = 0; @endphp
                                        @foreach($years as $year)
                                            <td>
                                                @php $monthly = 0; @endphp
                                                @foreach($deposits[$year] as $d)
                                                    @if(($d->month == $month) && ($d->type == 'Monthly' || $d->type == 'Monthly With Due'))
                                                        {{ $d->amount }}<br>
                                                        @php $month_total += $d->amount; $monthly += $d->amount; @endphp
                                                    @endif
                                                @endforeach
                                            </td>
                                        @endforeach
                                        <td style="background-color:#18666f;color:white;font-weight:bold">{{ $month_total }}</td>
                                    </tr>
                                @endforeach

                                {{-- Yearly --}}
                                <tr>
                                    <td><b>Yearly</b></td>
                                    @php $yearly_total = 0; @endphp
                                    @foreach($years as $year)
                                        <td>
                                            @php $yearly = 0; @endphp
                                            @foreach($deposits[$year] as $d)
                                                @if($d->type == 'Yearly')
                                                    {{ $d->amount }}<br>
                                                    @php $yearly_total += $d->amount; $yearly += $d->amount; @endphp
                                                @endif
                                            @endforeach
                                        </td>
                                    @endforeach
                                    <td style="background-color:#18666f;color:white;font-weight:bold">{{ $yearly_total }}</td>
                                </tr>

                                {{-- Profit --}}
                                <tr>
                                    <td><b>Profit</b></td>
                                    @php $profit_total = 0; @endphp
                                    @foreach($years as $year)
                                        @php
                                            $p = $profits[$year] ?? 0;
                                            $profit_total += $p;
                                        @endphp
                                        <td><b>{{ $p > 0 ? $p : '' }}</b></td>
                                    @endforeach
                                    <td style="background-color:#18666f;color:white;font-weight:bold">{{ $profit_total }}</td>
                                </tr>

                                {{-- Year Totals --}}
                                <tr>
                                    <td><b>Total</b></td>
                                    @php $grandTotal = 0; @endphp
                                    @foreach($years as $year)
                                        @php
                                            $yearSum = $deposits[$year]->sum('amount') + ($profits[$year] ?? 0);
                                            $grandTotal += $yearSum;
                                        @endphp
                                        <td style="background:#064073;color:white"><b>{{ $yearSum }}</b></td>
                                    @endforeach
                                    <td style="background:#064073;color:white"><b>{{ $grandTotal }}</b></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

