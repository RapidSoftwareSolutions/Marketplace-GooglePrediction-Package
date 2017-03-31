<?php
$app->post('/api/GooglePrediction/trainModel', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'projectId', 'modelId']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . 'projects/' . $post_data['args']['projectId'] . '/trainedmodels';
    $body = array();
    $body['id'] = $post_data['args']['modelId'];
    if (isset($post_data['args']['sourceModel']) && strlen($post_data['args']['sourceModel']) > 0) {
        $body['sourceModel'] = $post_data['args']['sourceModel'];
    }
    if (isset($post_data['args']['storageDataLocation']) && strlen($post_data['args']['storageDataLocation']) > 0) {
        $body['storageDataLocation'] = $post_data['args']['storageDataLocation'];
    }
    if (isset($post_data['args']['storagePMMLLocation']) && strlen($post_data['args']['storagePMMLLocation']) > 0) {
        $body['storagePMMLLocation'] = $post_data['args']['storagePMMLLocation'];
    }
    if (isset($post_data['args']['modelType']) && strlen($post_data['args']['modelType']) > 0) {
        $body['modelType'] = $post_data['args']['modelType'];
    }
    if (isset($post_data['args']['trainingInstancesOutput']) && strlen($post_data['args']['trainingInstancesOutput']) > 0) {
        $body['trainingInstances']['output'] = $post_data['args']['trainingInstancesOutput'];
    }
    if (isset($post_data['args']['trainingInstancesCsvInstance']) && strlen($post_data['args']['trainingInstancesCsvInstance']) > 0) {
        $body['trainingInstances']['csvInstance'] = $post_data['args']['trainingInstancesCsvInstance'];
    }
    if (isset($post_data['args']['utility']) && strlen($post_data['args']['utility']) > 0) {
        $body['utility'] = $post_data['args']['utility'];
    }

    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->request('POST', $query_str, [
            'headers' => [
                'Authorization' => 'Bearer ' . $post_data['args']['accessToken']
            ],
            'json' => $body
        ]);

        $responseBody = $resp->getBody()->getContents();
        $rawBody = json_decode($resp->getBody());

        $all_data[] = $rawBody;
        if ($response->getStatusCode() == '200') {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($all_data) ? $all_data : json_decode($all_data);
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {
        $responseBody = $exception->getResponse()->getReasonPhrase();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $responseBody;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\BadResponseException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }


    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});