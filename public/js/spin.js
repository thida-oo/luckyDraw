const wheel = document.getElementById("wheel");

const spinBtn = document.getElementById("spin-btn");
// document.getElementById
const spinResult = document.getElementById("final-value");

//minDegree 是 按 礼品的可能性 来设置 

// const rotationValues = [
//     { minDegree: 0, maxDegree: 30, value: 2 },
//     { minDegree: 31, maxDegree: 90, value: 1 },
//     { minDegree: 91, maxDegree: 150, value: 6 },
//     { minDegree: 151, maxDegree: 210, value: 5 },
//     { minDegree: 211, maxDegree: 270, value: 4 },
//     { minDegree: 271, maxDegree: 330, value: 3 },
//     { minDegree: 331, maxDegree: 360, value: 2 },
// ];


//Size of each piece
//const data = [16, 16, 16, 16, 16, 16];

const data = probData;
const present_value = presentId; 
const label = presentLabel; alert(present_value);
const degree = calPieData(probData);
var rotationArray = [];

calRotation(degree, present_value);

function calRotation(degree, label){ 

    var minDegree = 0;
    var maxDegree = 360; var temp = 0;
    var value = 0;

    for(j=0; j<degree.length; j++){
        var index = degree.length-j-1;
        value = label[index];

        temp = degree[j];
        maxDegree = minDegree + temp;
       
        var temp = {
            'minDegree' : minDegree,
            'maxDegree' : maxDegree,
            'value': value
        }
        rotationArray.push(temp);

        minDegree = ++maxDegree;
                
    }

}
const rotationValues = rotationArray;
// calculate Degree
function calDegree(percent){
    var degree = 360;
    var pieDegree = Math.floor(degree * (percent/100));
    return pieDegree;
}

function calPieData(probData){ 
    var pieData = [];
    for(i=0; i<probData.length; i++){
        pieData[i] = calDegree(probData[i]);
    }
    return pieData;
}

//background color for each piece
var pieColors = [
    "#0bb27a",
    "#4ad6a3",
    "#0bb27a",
    "#4ad6a3",
    "#0bb27a",
    "#4ad6a3",
];

let spinChart = new Chart(wheel, {
    plugins: [ChartDataLabels],  
    type: "pie",
    data: {
        labels: presentLabel,
        datasets: [{
            backgroundColor: pieColors,
            data: present_value,
           
        }, ],
    },
    options: {
        responsive: true,
        animation: { duration: 0 },
        plugins: {
            toooltip: false,
            legend: {
                display: false,
            },
        },
        datalabels: {
            color: "#ffffff",
            display:true,
            //formatter: (_, context) => context.chart.data.labels[context.dataIndex],
            formatter: (val, context) => {
                const labels = context.chart.data.labels[context.dataIndex];
                const formattedVal = Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2,
                  }).format(val);
                return `${labels}: ${formattedVal}`;
            },
            font: { size: 16 },
            align:'end',
            anchor:'end',
        },
    },

});

const valueGenerate = (angleValue) => {

    for (let i of rotationValues) { 

        if (angleValue >= i.minDegree && angleValue <= i.maxDegree) { 
            spinResult.innerHTML = `<p id="finalValue"> Value:${i.value}</p>`;
            spinBtn.disabled = false;

            break;
        }
    }
};

let count = 0;
let resultValue = 101;
spinBtn.addEventListener("click", () => { 
    spinBtn.disabled = true;
    spinResult.innerHTML = `<p> Good Luck</p>`;
    let randomDegree = Math.floor(Math.random() * (355 - 0 + 1) + 0);
    
  //  alert("RD... "+randomDegree); alert("SS.."+ spinChart.options.rotation);

    let rotationInterval = window.setInterval(() => {
        spinChart.options.rotation = spinChart.options.rotation + resultValue;
        //alert("inn.."+ spinChart.options.rotation);
        spinChart.update();
        if (spinChart.options.rotation >= 360) {
            count += 1;
            resultValue -= 5;
            spinChart.options.rotation = 0;
        } else if (count > 15 && spinChart.options.rotation == randomDegree) {

           // alert("C.."+count); alert(">15.. "+spinChart.options.rotation);

            valueGenerate(randomDegree);
            clearInterval(rotationInterval);
            count = 0;
            resultValue = 101;
        }

    }, 10);
});