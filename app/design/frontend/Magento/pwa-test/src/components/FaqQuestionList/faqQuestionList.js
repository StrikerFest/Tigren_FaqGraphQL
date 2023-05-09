import React, { useState } from 'react';
import { ApolloClient, gql, InMemoryCache, useQuery } from '@apollo/client';
import { ApolloProvider } from 'react-apollo';
import ProductFullDetail from '../ProductFullDetail';

const client = new ApolloClient({
    uri: 'https://pwa-test.local.pwadev:8525/graphql',
    cache: new InMemoryCache()
});

const GET_FAQ_QUESTIONS = gql`
    query {
        faqs {
            faq_id
            question
            author
            answer
            status
            product
            position
        }
    }
`;

const FaqQuestionList = () => {
    const { loading, error, data, refetch } = useQuery(GET_FAQ_QUESTIONS, {
        fetchPolicy: 'network-only'
    });

    const handlePageChange = (pageNumber) => {
        refetch({ currentPage: pageNumber });
    };
    React.useEffect(() => {
        refetch();
    }, [refetch]);

    if (loading) return <p>Loading...</p>;
    if (error) return <p>Error =( {error.message}</p>;

    const handleQuestionClick = (question) => {
        window.location.href = `https://pwa-test.local.pwadev:8525/tigren_question/edit/${question.question_id}`;
    };

    return (
        <div>
            <ul >
                {data.faqs.map(list => (
                    <li key={list.faq_id}>
                        <hr />
                        Author name: {list.author}
                        <br /> Question: {list.question}
                        <br /> Answer: {list.answer}
                        <br /> Status: {list.status === 'Answered'
                        ? <span style={{color: 'green'}}>{list.status}</span>
                        : <span style={{color: 'blue'}}>{list.status}</span>}
                        <br />
                        <br />
                        </li>
                ))}
            </ul>
        </div>
    );
};

export default FaqQuestionList;
