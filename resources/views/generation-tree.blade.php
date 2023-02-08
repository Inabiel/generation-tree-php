<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tree Page</title>
    <script src="https://unpkg.com/gojs/release/go-debug.js"></script>
</head>
<body>
    {{-- {{$outputtedData}} --}}
    <div id="myDiagramDiv"
    style="width:1920px; height:1080px; background-color: #DAE4E4;"></div>
<script>
    let datas = {!! json_encode($outputtedData['data']) !!};
    let formattedData = datas.map((ele, index)=>{
        return {key: index+1,name: ele.name, background: ele.gender == 0 ?  "#a83861" : "#44CCFF", gender:ele.gender, parent:ele.parent_id ? ele.parent_id : "null", generation_number: ele.generation_number}
    })
    console.log(formattedData)
    const myDiagram = new go.Diagram("myDiagramDiv",
  {
    "undoManager.isEnabled": true,
    layout: new go.TreeLayout({ angle: 90, layerSpacing: 35 })
  });

// the template we defined earlier
myDiagram.nodeTemplate =
  new go.Node("Horizontal", {width:100, height:80}).bind('background', 'background')
    .add(new go.TextBlock("Default Text",
        { margin: 12, stroke: "white", font: "bold 16px sans-serif" })
        .bind("text", "name"));

// the same model as before
myDiagram.model = new go.TreeModel(
  formattedData
  );
</script>
</body>
</html>
