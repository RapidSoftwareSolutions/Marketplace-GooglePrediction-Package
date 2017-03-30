       <?php
       $routes = [
       'deleteModel',
       'addDataToModel',
       'getTrainedModelsPrediction',
       'checkModelTrainingStatus',
       'getModels',
       'getModelAnalysisResult',
       'trainModel',
       'predictWithHostedModel',
       'refreshAccessToken',
       'revokeAccessToken',
       'getAccessToken',
        'metadata'
       ];
       foreach ($routes as $file) {
           require __DIR__ . '/../src/routes/' . $file . '.php';
       }

