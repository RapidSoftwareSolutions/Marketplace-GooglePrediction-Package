<?php

namespace Test\Functional;

require_once(__DIR__ . '/../../src/Models/checkRequest.php');

class GooglePredictionTest extends BaseTestCase
{

    public function testListMetrics()
    {

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
            'getAccessToken'
        ];

        foreach ($routes as $file) {
            $var = '{  
                    }';
            $post_data = json_decode($var, true);

            $response = $this->runApp('POST', '/api/GooglePrediction/' . $file, $post_data);

            $this->assertEquals(200, $response->getStatusCode(), 'Error in ' . $file . ' method');
        }
    }

}
