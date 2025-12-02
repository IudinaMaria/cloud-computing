<?php
require __DIR__ . '/../vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

$client = new DynamoDbClient([
    'region'  => 'eu-central-1',
    'version' => 'latest'
]);

$table = "TodosDDB";

function ddb_get_all() {
    global $client, $table;
    return $client->scan(['TableName' => $table])['Items'];
}

function ddb_put($id, $title, $status) {
    global $client, $table;
    return $client->putItem([
        'TableName' => $table,
        'Item' => [
            'id'     => ['S' => $id],
            'title'  => ['S' => $title],
            'status' => ['S' => $status]
        ]
    ]);
}

function ddb_delete($id) {
    global $client, $table;
    return $client->deleteItem([
        'TableName' => $table,
        'Key' => ['id' => ['S' => $id]]
    ]);
}

function ddb_update($id, $status) {
    global $client, $table;
    return $client->updateItem([
        'TableName' => $table,
        'Key' => ['id' => ['S' => $id]],
        'UpdateExpression' => "SET #s = :newStatus",
        'ExpressionAttributeNames' => ['#s' => 'status'],
        'ExpressionAttributeValues' => [
            ':newStatus' => ['S' => $status]
        ]
    ]);
}
?>
