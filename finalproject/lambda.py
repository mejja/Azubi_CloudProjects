import boto3

def lambda_handler(event, context):
    # Extract relevant information from the DynamoDB trigger event
    for record in event['Records']:
        if record['eventName'] == 'INSERT':
            new_image = record['dynamodb']['NewImage']
            user_email = new_image['Email']['S']
            # ... Extract any other necessary information ...

            # Create an SES client
            ses = boto3.client('ses')

            # Send an email to the new subscriber
            response = ses.send_email(
                Source='verified_email',  # Replace with your verified email address
                Destination={
                    'ToAddresses': [user_email]
                },
                Message={
                    'Subject': {
                        'Data': 'Welcome to Our Service'
                    },
                    'Body': {
                        'Text': {
                            'Data': 'Thank you for filling out the form. Welcome to the Gold Grid family!'
                        }
                    }
                }
            )

            print('Email sent successfully: ' + response['MessageId'])



