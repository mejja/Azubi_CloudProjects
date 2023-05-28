import boto3

def lambda_handler(event, context):
    # Extract relevant information from the DynamoDB trigger event
    user_email = event['Records'][0]['dynamodb']['NewImage']['email']['S']
    # ... Extract any other necessary information ...

    # Create an SES client
    ses = boto3.client('ses')

    # Send an email to the new subscriber
    response = ses.send_email(
        Source='majorkiema.mk@gmail.com',  # Replace with your verified email address
        Destination={
            'ToAddresses': [user_email]
        },
        Message={
            'Subject': {
                'Data': 'Welcome to Our Service'
            },
            'Body': {
                'Text': {
                    'Data': 'Hello, thank you for Registering with US!'
                }
            }
        }
    )

    return 'Email sent successfully: ' + response['MessageId']

