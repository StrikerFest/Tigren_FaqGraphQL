import React, { useState, useEffect } from 'react';
import { ApolloClient, gql, InMemoryCache, useQuery } from '@apollo/client';
import { ApolloProvider, useMutation } from 'react-apollo';

const client = new ApolloClient({
    uri: 'https://pwa-test.local.pwadev:8525/graphql',
    cache: new InMemoryCache()
});

const CREATE_FAQ_QUESTIONS = gql`
    mutation($question: String!, $author: String!,$product: String!) {
        createFaq(
            question: $question
            author: $author
            product: $product
        ) {
            question
            author
            product
        }
    }
`;

const FaqQuestionCreate = (props) => {
    const [formValues, setFormValues] = useState({
        author: '',
        question: '',
        product: props.sku
    });
    const [submitQuestion] = useMutation(CREATE_FAQ_QUESTIONS);
    // TODO: TEST PASSING SKU TO RESOLVER
    const handleSubmit = (event) => {
        event.preventDefault();
        submitQuestion({
            variables: {
                author: formValues['author'],
                question: formValues['question'],
                product: formValues['product']
            }
        }).then(() => {
            setFormValues({
                author: '',
                question: '',
                product: props.sku
            });
        });
        setFormValues({
            author: '',
            question: '',
            product: props.sku
        });

    };
    const handleChange = (event) => {
        const { name, value } = event.target;
        setFormValues((prevState) => ({
            ...prevState,
            [name]: value
        }));
    };

    return (
        <form onSubmit={handleSubmit}>
            <table style={{ width: '100%' }}>
                <tbody>
                <tr>
                    <td style={{ border: 'black solid 1px', padding: '5px' }}>Author:</td>
                    <td style={{ border: 'black solid 1px', padding: '5px' }}>
                        <input type="text" name="author" onChange={handleChange} className="form-input" />
                    </td>
                </tr>
                <tr>
                    <td style={{ border: 'black solid 1px', padding: '5px' }}>Question:</td>
                    <td style={{ border: 'black solid 1px', padding: '5px' }}>
                            <textarea name="question" style={{ width: '100%' }} rows={5} onChange={handleChange}
                                      className="form-input" />
                    </td>
                </tr>
                <tr>
                    <td colSpan={2}>
                        <br/>
                        <button style={{border: "black 1px solid", borderRadius: "10px", padding: "5px",width: "100%"}}  type="submit" className="btn btn-submit">Save</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    );
};

export default FaqQuestionCreate;
