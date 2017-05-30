[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/GooglePrediction/functions?utm_source=RapidAPIGitHub_GooglePredictionFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# GooglePrediction Package
Build and train cloud-based machine learning models.
* Domain: [GooglePrediction](http://cloud.google.com)
* Credentials: apiKey, apiSecret

## How to get credentials: 
1. Go to the [Google API Console](https://console.developers.google.com/flows/enableapi?apiid=prediction)
2. Create or select a project.
3. Click Continue to enable the API.
4. On the Credentials page, get an API key and API Secret. 


## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```
 

## GooglePrediction.getAccessToken
Get access token

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Api key obtained from Google
| apiSecret  | credentials| Api secret obtained from Google
| redirectUri| String     | Your redirect Uri
| code       | String     | Code provided by client

## GooglePrediction.revokeAccessToken
revoke access token

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| User access token

## GooglePrediction.refreshAccessToken
Refresh access token

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Api key obtained from Google
| apiSecret   | credentials| Api secret obtained from Google
| refreshToken| String     | refresh token provided in getAccessToken block

## GooglePrediction.predictWithHostedModel
Submit input and request an output against a hosted model.

| Field          | Type  | Description
|----------------|-------|----------
| accessToken    | String| Api key obtained from Google
| projectId      | String| Id of the project
| hostedModelName| String| Name of the hosted model
| csvInstance    | List  | A list of input features, these can be strings or doubles.

## GooglePrediction.trainModel
Train a Prediction API model.

| Field                       | Type  | Description
|-----------------------------|-------|----------
| accessToken                 | String| Api key obtained from Google
| projectId                   | String| Id of the project
| modelId                     | String| Id of the model. If you train a model that already exists in a project, the model will be overwritten.
| sourceModel                 | String| The Id of the model to be copied over.
| storageDataLocation         | String| Google storage location of the training data file.
| storagePMMLLocation         | String| Google storage location of the preprocessing pmml file.
| modelType                   | Select| Type of predictive model (CLASSIFICATION or REGRESSION)
| trainingInstancesOutput     | String| The generic output value - could be regression or class label.
| trainingInstancesCsvInstance| List  | The input features for this instance.
| utility                     | List | A class weighting function, which allows the importance weights for class labels to be specified (Categorical models only).

## GooglePrediction.getModelAnalysisResult
Get analysis of the model and the data the model was trained on.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Api key obtained from Google
| projectId  | String| Id of the project
| modelId    | String| Id of the model.

## GooglePrediction.getModels
List available models.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Api key obtained from Google
| projectId  | String| Id of the project
| maxResults | Number| Maximum number of results to return.
| pageToken  | String| Pagination token.

## GooglePrediction.checkModelTrainingStatus
Check training status of your model.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Api key obtained from Google
| projectId  | String| Id of the project
| modelId    | String| Id of the model.

## GooglePrediction.getTrainedModelsPrediction
Submit model id and request a prediction.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Api key obtained from Google
| projectId  | String| Id of the project
| modelId    | String| Id of the model.
| csvInstance| List  | A list of input features, these can be strings or doubles.

## GooglePrediction.addDataToModel
Add new data to a trained model.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Api key obtained from Google
| projectId  | String| Id of the project
| modelId    | String| Id of the model.
| csvInstance| List  | A list of input features, these can be strings or doubles.
| output     | String| The generic output value - could be regression or class label.

## GooglePrediction.deleteModel
Delete a trained model.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Api key obtained from Google
| projectId  | String| Id of the project
| modelId    | String| Id of the model.

