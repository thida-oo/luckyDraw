@extends('layouts.app')

@section('content')

    <style type="text/css">
text{
    font-family:Helvetica, Arial, sans-serif;
    font-size:11px;
    pointer-events:none;
}

#question h1{

-webkit-transform:translate(0,-50%);
        transform:translate(0,-50%);
}

@media (max-width: 767px) {
#chart, #question {
    width: 100%;
  }
}
@media (min-width: 370px) and (max-width: 456px) {
    #question{
        margin-left: 24%;
    }
}
#chart, #question {
  display: flex;
  flex-wrap: wrap;
}

#chart {
  flex: 1;
}

#question {
  flex: 1;
}
.row{
    margin-left: 10%;
}
#question{
    position: relative;
    left: 8%;
}
.event-name{
    position: relative;
    left: 8%;
}
#present-name{
    position: relative;
    left: 7%;
}
    </style>

<div class="container">
    <div class="row no-gutters">
       <div class="col-12">
               <h4> {{$valid_event->name}} </h4> 
               <p>
                    <span style="color: red;">Start Date</span> 
                - <?php echo date('d-m-Y',strtotime($valid_event->event_start_time)); ?> 
                <i class="fa fa-arrows-h px-2" aria-hidden="true"></i>
                    <span style="color: red;">End Date</span> 
                - <?php echo date('d-m-Y',strtotime($valid_event->event_end_time)); ?>
                </p>
               <small id="screenshoot_msg"></small>
       </div>
       <div class="col-sm-4 col-lg-4 col-md-4">
              <div id="chart"></div>
        </div>
        <div class="col-sm-8 col-lg-8 col-md-8">
            <div class="row text-left">
                <div id="present-name" style="font-weight: bold;" class="mt-4 col-sm-12 col-lg-12 col-md-12"></div>
                <div class="col-sm-12 col-lg-12 col-md-12 mt-4">
                  <img src="" class="imgDiv px-2" id="imgDiv" width="180px" />
               </div>
            </div>
        </div>
          </div>
        </div>

    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        var padding = {top:20, right:40, bottom:0, left:0},
            w = 300 - padding.left - padding.right,
            h = 300 - padding.top  - padding.bottom,
            r = Math.min(w, h)/2,
            rotation = 0,
            oldrotation = 0,
            picked = 100000,
            color = d3.scale.category20();//category20c()
            //randomNumbers = getRandomNumbers();
        var data = [
            @foreach($present_draw as $value)
                {"label":"{{$value->present_name}}", "value":{{$imei_sn}},"present_id": {{$value->present_id}} ,"question":"{{$value->present_name}}"},
            @endforeach
        ];
        var svg = d3.select('#chart')
            .append("svg")
            .data([data])
            .attr("width",  w + padding.left + padding.right)
            .attr("height", h + padding.top + padding.bottom);
        var container = svg.append("g")
            .attr("class", "chartholder")
            .attr("transform", "translate(" + (w/2 + padding.left) + "," + (h/2 + padding.top) + ")");
        var vis = container
            .append("g");
            
        var pie = d3.layout.pie().sort(null).value(function(d){return 1;});
        // declare an arc generator function
        var arc = d3.svg.arc().outerRadius(r);
        // select paths, use arc generator to draw
        var arcs = vis.selectAll("g.slice")
            .data(pie)
            .enter()
            .append("g")
            .attr("class", "slice");
            
        arcs.append("path")
            .attr("fill", function(d, i){ return color(i); })
            .attr("d", function (d) { return arc(d); });
        // add the text
        arcs.append("text").attr("transform", function(d){
                d.innerRadius = 0;
                d.outerRadius = r;
                d.angle = (d.startAngle + d.endAngle)/2;
                return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius -10) +")";
            })
            .attr("text-anchor", "end")
            .text( function(d, i) {
                return data[i].label;
            });
        container.on("click", spin);
        function spin(d){
            
            container.on("click", null);
            console.log('test');
            console.log( "Data length: " + data.length);

            var  ps       = 360/data.length,
                 pieslice = Math.round(1440/data.length),
                 rng      = Math.floor((Math.random() * 1440) + 360);
                
            rotation = (Math.round(rng / ps) * ps);
            
            picked = Math.round(data.length - (rotation % 360)/ps);
            picked = picked >= data.length ? (picked % data.length) : picked;
            // if(oldpick.indexOf(picked) !== -1){
            //     d3.select(this).call(spin);
            //     return;
            // } else {
            //     oldpick.push(picked);
            // }
            rotation += 90 - Math.round(ps/2);
            vis.transition()
                .duration(Math.floor(Math.random() * 7000) + 3000)
                .attrTween("transform", rotTween)
                .each("end",async function(){
                    //mark question as seen
                        d3.select(".slice:nth-child(" + (picked + 1) + ") path")
                            // .attr("fill", "none");
                    //populate question
                    d3.select("#question h3")
                        .text(data[picked].question);
                    oldrotation = rotation;
                    var present_id = data[picked].present_id
                      try {
                            const response = await fetch('/draw/present', {
                              method: 'POST',
                              body: JSON.stringify({
                                imei: {{$imei_sn}},
                                present_id: present_id
                              }),
                              headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                              }
                            });
                            const data = await response.json();

                            console.log(data)
                            console.log(data.state)
                            if(data.state==false){
                                document.getElementById('present-name').innerHTML = data.msg;
                                document.getElementById("imgDiv").src = "";

                            }else if(data.state==true){
                                document.getElementById('present-name').innerHTML = data.present[0].present_name;
                                document.getElementById("imgDiv").src = "/image/presentsImage/" + data.present[0].image;
                                document.getElementById('screenshoot_msg').innerHTML = data.msg;
                            }
                          } catch (error) {
                            console.error(error);
                          }                
                           container.on("click", spin);
                });
        }
        //make arrow
        svg.append("g")
            .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")
            .append("path")
            .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")
            .style({"fill":"black"});
        //draw spin circle
        container.append("circle")
            .attr("cx", 0)
            .attr("cy", 0)
            .attr("r", 40)
            .style({"fill":"white","cursor":"pointer"});
        //spin text
        container.append("text")
            .attr("x", 0)
            .attr("y", 15)
            .attr("text-anchor", "middle")
            .text("SPIN")
            .style({"font-weight":"bold", "font-size":"30px"});
        
        
        function rotTween(to) {
          var i = d3.interpolate(oldrotation % 360, rotation);
          return function(t) {
            return "rotate(" + i(t) + ")";
          };
        }
        
        
        function getRandomNumbers(){
            var array = new Uint16Array(1000);
            var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);
            if(window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function"){
                window.crypto.getRandomValues(array);
                console.log("works");
            } else {
                //no support for crypto, get crappy random numbers
                for(var i=0; i < 1000; i++){
                    array[i] = Math.floor(Math.random() * 100000) + 1;
                }
            }
            return array;
        }
    </script>


@endsection
